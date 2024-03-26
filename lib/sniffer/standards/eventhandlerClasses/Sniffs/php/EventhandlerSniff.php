<?php
namespace PHP_CodeSniffer\Standards\EventhandlerClasses\Sniffs\PHP;

use Bitrix\Main\Localization\Loc;
use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

class EventhandlerSniff implements Sniff
{
	public function register()
	{
		return [
			T_FUNCTION,
		];
	}

	public function process(File $phpcsFile, $stackPtr)
	{
		$tokens = $phpcsFile->getTokens();
		$methodProps = $phpcsFile->getMethodProperties($stackPtr);

		if (!$methodProps['is_static']) {
			$current = $phpcsFile->findNext(T_STRING, $stackPtr + 1);
			$error = Loc::getMessage('INTERVOLGA_EDU.SNIFFER.NOT_STATIC_METHOD', ['#NAME#' => $tokens[$current]['content']]);
			$phpcsFile->addError($error, $stackPtr, 'EventhandlerSniff(notStaticMethod)');
		}
	}
}