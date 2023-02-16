<?php
namespace Intervolga\Edu\Sniffer\Filters;


class Filter extends \PHP_CodeSniffer\Filters\Filter{
	/**
	 * Checks filtering rules to see if a file should be checked.
	 *
	 * Checks both file extension filters and path ignore filters.
	 *
	 * @param string $path The path to the file being checked.
	 *
	 * @return bool
	 */
	protected function shouldProcessFile($path)
	{
		// Check that the file's extension is one we are checking.
		// We are strict about checking the extension and we don't
		// let files through with no extension or that start with a dot.
		$fileName  = basename($path);
		$fileParts = explode('.', $fileName);
		if ($fileParts[0] === $fileName) {
			return false;
		}

		// Checking multi-part file extensions, so need to create a
		// complete extension list and make sure one is allowed.
		$extensions = [];
		array_shift($fileParts);
		foreach ($fileParts as $part) {
			$extensions[implode('.', $fileParts)] = 1;
			array_shift($fileParts);
		}

		$matches = array_intersect_key($extensions, $this->config->extensions);
		if (empty($matches) === true) {
			return false;
		}

		return true;

	}//end shouldProcessFile()
}