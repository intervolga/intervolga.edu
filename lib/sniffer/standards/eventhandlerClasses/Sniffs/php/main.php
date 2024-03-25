<?php
namespace PHP_CodeSniffer\Standards\EventhandlerClasses\Sniffs\PHP;

use PHP_CodeSniffer\Files\File;

class Main
{
	public function process(File $phpcsFile, $stackPtr)
	{
		\Bitrix\Main\Diag\Debug::dump('here');
		$tokens = $phpcsFile->getTokens();
		$token = $tokens[$stackPtr];
		$token['content'] = preg_replace("/'|\"/", '', $token['content']);
/*
		if (in_array($token['content'], static::INIT_CONSTANTS)) {
			$file = new \Bitrix\Main\IO\File($phpcsFile->getFilename());
			$error = Loc::getMessage('IV_EDU.NEW_ACADEMY.C_2.L_2.INIT_CONSTANTS', [
				'#FILE#' => FileMessage::get($file),
				'#NAME#' => $token['content'],
			]);
			$phpcsFile->addError($error, $stackPtr, 'ShouldntExistSniff_INIT_CONSTANTS');
		}*/
	}
}