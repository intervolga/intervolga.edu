<?php
namespace Intervolga\Edu\Sniffer\Standards\General\Sniffs\PHP;

use Bitrix\Main\IO\File;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Util\Admin;
use Intervolga\Edu\Util\FileSystem;
use PHP_CodeSniffer\Sniffs\Sniff;

class CheckCustomCoreSniff implements Sniff
{
	public function register()
	{
		return [T_CONSTANT_ENCAPSED_STRING];
	}

	public function process(\PHP_CodeSniffer\Files\File $phpcsFile, $stackPtr)
	{
		$tokens = $phpcsFile->getTokens();
		$token = $tokens[$stackPtr];

		if (preg_match('/B_PROLOG_INCLUDED/mi', $token['content'])) {
			$prevToken = $phpcsFile->findPrevious(T_WHITESPACE, ($stackPtr - 1), null, true);
			if ($tokens[$prevToken]['type'] == 'T_OPEN_PARENTHESIS') {
				$prevTokenDefine = $phpcsFile->findPrevious(T_WHITESPACE, ($prevToken - 1), null, true);
				if (strtolower($tokens[$prevTokenDefine]['content']) == 'defined') {

					$file = new File($phpcsFile->getFilename());
					$error = Loc::getMessage('INTERVOLGA_EDU.SNIFFER_CUSTOM_CORE', [
						'#FILE#' => Loc::getMessage('INTERVOLGA_EDU.FSE', [
							'#NAME#' => $file->getName(),
							'#PATH#' => FileSystem::getLocalPath($file),
							'#FILEMAN_URL#' => Admin::getFileManUrl($file),
						]),
					]);
					$phpcsFile->addError($error, $stackPtr, 'A1CheckCustomCoreSniff');
				}
			}

		}

	}
}