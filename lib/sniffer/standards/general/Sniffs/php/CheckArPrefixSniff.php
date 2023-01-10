<?php

namespace Intervolga\Edu\Sniffer\Standards\General\Sniffs\PHP;

use PHP_CodeSniffer\Sniffs\Sniff;

class CheckArPrefixSniff implements Sniff
{
	public function register()
	{
		return [T_VARIABLE];
	}

	public function process(\PHP_CodeSniffer\Files\File $phpcsFile, $stackPtr)
	{
		$tokens = $phpcsFile->getTokens();
		$token = $tokens[$stackPtr];

		if (preg_match('/\$ar.+/', $token['content'])) {
			if (!in_array($token['content'], [
				'$arResult',
				'$arParams'
			])) {
				$error = "Недопустимо название переменной {$token['content']}";
				$phpcsFile->addError($error, $stackPtr, 'A1CheckArPrefix');
			}
		}
	}
}