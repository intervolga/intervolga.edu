<?php
namespace Intervolga\Edu\Sniffer;

use Intervolga\Edu\Exceptions\AssertException;
use PHP_CodeSniffer\Autoload;
use PHP_CodeSniffer\Config;
use PHP_CodeSniffer\Exceptions\DeepExitException;
use PHP_CodeSniffer\Exceptions\RuntimeException;
use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Files\FileList;
use PHP_CodeSniffer\Ruleset;
use PHP_CodeSniffer\Util\Common;
use PHP_CodeSniffer\Util\Standards;
use PHP_CodeSniffer\Util\Tokens;

class Runner
{
	public Config $config;
	public ?Ruleset $ruleset = null;

	public function __construct(Config $config)
	{
		$this->config = $config;
		$this->init();
	}

	public function init()
	{
		ini_set('auto_detect_line_endings', "1");

		// Check that the standards are valid.
		foreach ($this->config->standards as $standard) {
			if (Standards::isInstalledStandard($standard) === false) {
				$error = 'Ошибка модуля : стандарт "' . $standard . '" не найден.';
				throw new AssertException($error);
			}
		}

		// Saves passing the Config object into other objects that only need
		// the verbosity flag for debug output.
		if (defined('PHP_CODESNIFFER_VERBOSITY') === false) {
			define('PHP_CODESNIFFER_VERBOSITY', $this->config->verbosity);
		}

		// Create this class, so it is autoloaded and sets up a bunch
		// of PHP_CodeSniffer-specific token type constants.
		$tokens = new Tokens();

		// Allow autoloading of custom files inside installed standards.
		$installedStandards = Standards::getInstalledStandardDetails();
		foreach ($installedStandards as $name => $details) {
			Autoload::addSearchPath($details['path'], $details['namespace']);
		}

		// The ruleset contains all the information about how the files
		// should be checked and/or fixed.
		try {
			$this->ruleset = new Ruleset($this->config);
		} catch (RuntimeException $e) {
			$error = 'ERROR: ' . $e->getMessage() . PHP_EOL . PHP_EOL;
			$error .= $this->config->printShortUsage(true);
			throw new DeepExitException($error, 3);
		}

	}

	public function handleErrors($code, $message, $file, $line)
	{
		if ((error_reporting() & $code) === 0) {
			return true;
		}

		throw new RuntimeException("$message in $file on line $line");
	}

	public function runPHPCS(): array
	{
		if (empty($this->config->files) === true) {
			$error = 'ERROR: You must supply at least one file or directory to process.' . PHP_EOL . PHP_EOL;
			$error .= $this->config->printShortUsage(true);
			throw new DeepExitException($error, 3);
		}

		$todo = new FileList($this->config, $this->ruleset);

		// Turn all sniff errors into exceptions.
		set_error_handler([
			$this,
			'handleErrors'
		]);

		$errors = [];
		$lastDir = '';
		foreach ($todo as $path => $file) {
			if ($file->ignored === true) {
				continue;
			}

			$currDir = dirname((string)$path);
			if ($lastDir !== $currDir) {
				if (PHP_CODESNIFFER_VERBOSITY>0) {
					echo 'Changing into directory ' . Common::stripBasepath($currDir, $this->config->basepath) . PHP_EOL;
				}
				$lastDir = $currDir;
			}

			$errors[$file->getFilename()] = $this->processFile($file);
		}

		return $errors;
	}

	public function processFile(File $file): array
	{
		try {
			$file->process();
		} catch (\Exception $e) {
			$error = 'An error occurred during processing; checking has been aborted. The error message was: ' . $e->getMessage();
			$file->addErrorOnLine($error, 1, 'Internal.Exception');
		} finally {
			$file->cleanUp();
		}

		return $file->getErrors();
	}
}
