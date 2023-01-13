<?php
namespace Intervolga\Edu\Sniffer\Standards\General\Sniffs\PHP;

use Bitrix\Main\IO\File;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Util\Admin;
use Intervolga\Edu\Util\FileSystem;
use PHP_CodeSniffer\Sniffs\Sniff;

class ShortPhpTagSniff implements Sniff
{
	public function register()
	{
		return [T_OPEN_TAG];
	}

	public function process(\PHP_CodeSniffer\Files\File $phpcsFile, $stackPtr)
	{
		$tokens = $phpcsFile->getTokens();
		$token = $tokens[$stackPtr];

		if (strlen($token['content']) === 2) {
			$file = new File($phpcsFile->getFilename());
			$error = Loc::getMessage('INTERVOLGA_EDU.SNIFFER_SHORT_PHP_TAG', [
				'#FILE#' => Loc::getMessage('INTERVOLGA_EDU.FSE', [
					'#NAME#' => $file->getName(),
					'#PATH#' => FileSystem::getLocalPath($file),
					'#FILEMAN_URL#' => Admin::getFileManUrl($file),
				]),
			]);
			$phpcsFile->addError($error, $stackPtr, 'A1SetAdditionalCSS');

		}

	}
}