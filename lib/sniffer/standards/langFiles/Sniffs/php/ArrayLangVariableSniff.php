<?php

namespace Intervolga\Edu\Sniffer\Standards\LangFiles\Sniffs\PHP;
use Bitrix\Main\Localization\Loc;
use PHP_CodeSniffer\Sniffs\Sniff;

Loc::loadMessages(__FILE__);
class ArrayLangVariableSniff implements Sniff
{
	public function register()
	{
		return [T_OPEN_SQUARE_BRACKET, T_STRING];
	}

	public function process(\PHP_CodeSniffer\Files\File $phpcsFile, $stackPtr)
	{
		$tokens = $phpcsFile->getTokens();
		$token = $tokens[$stackPtr];

		/*foreach ($tokens as $token){
			\Bitrix\Main\Diag\Debug::dump($token['type']);
			\Bitrix\Main\Diag\Debug::dump($token['content']);
		}*/

		if ($token['type'] === 'T_OPEN_SQUARE_BRACKET') {
			$nextToken = $phpcsFile->findNext(T_WHITESPACE, ($stackPtr + 1), null, true);
			if($tokens[$nextToken]['type'] === 'T_CONSTANT_ENCAPSED_STRING'){
				$error = $tokens[$nextToken]['content'];
				$phpcsFile->addError($error, $stackPtr, 'A1CheckArPrefix');
			}
		}
	}
}