<?php

namespace Intervolga\Edu\Sniffer\Standards\LangArrayFromTamplateDir\Sniffs\PHP;
use Bitrix\Main\Localization\Loc;
use PHP_CodeSniffer\Sniffs\Sniff;

Loc::loadMessages(__FILE__);
class LangArrayFromTemplateDirSniff implements Sniff
{
	public function register()
	{
		return [T_DOUBLE_COLON, T_STRING, T_OPEN_PARENTHESIS, T_CONSTANT_ENCAPSED_STRING];
	}

	public function process(\PHP_CodeSniffer\Files\File $phpcsFile, $stackPtr)
	{
		$tokens = $phpcsFile->getTokens();
		$token = $tokens[$stackPtr];

		/*foreach ($tokens as $token){
			\Bitrix\Main\Diag\Debug::dump($token['type']);
			\Bitrix\Main\Diag\Debug::dump($token['content']);
		}*/

		//Loc::getMessage("T_NEWS_DETAIL_BACK")

		if (strtolower($token['content']) === 'getmessage') {
			$nextToken = $phpcsFile->findNext(T_WHITESPACE, ($stackPtr + 1), null, true);
			if($tokens[$nextToken]['type'] === 'T_OPEN_PARENTHESIS'){
				$nextToken = $phpcsFile->findNext(T_WHITESPACE, ($nextToken + 1), null, true);
				if($tokens[$nextToken]['type'] === 'T_CONSTANT_ENCAPSED_STRING'){
					$error = $tokens[$nextToken]['content'];
					$phpcsFile->addError($error, $stackPtr, 'A1CheckArPrefix');
				}

			}
		}
	}
}