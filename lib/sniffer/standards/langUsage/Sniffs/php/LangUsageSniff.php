<?php
namespace Intervolga\Edu\Sniffer\Standards\LangArrayFromTamplateDir\Sniffs\PHP;

use Bitrix\Main\Localization\Loc;
use PHP_CodeSniffer\Sniffs\Sniff;

Loc::loadMessages(__FILE__);

class LangUsageSniff implements Sniff
{
	public function register()
	{
		return [
			T_STRING,
		];
	}

	public function process(\PHP_CodeSniffer\Files\File $phpcsFile, $stackPtr)
	{
		$tokens = $phpcsFile->getTokens();
		$token = $tokens[$stackPtr];

		if (strtolower($token['content']) === 'getmessage') {
			$nextToken = $phpcsFile->findNext(T_WHITESPACE, ($stackPtr + 1), null, true);
			if ($tokens[$nextToken]['type'] === 'T_OPEN_PARENTHESIS') {
				$nextToken = $phpcsFile->findNext(T_WHITESPACE, ($nextToken + 1), null, true);
				if ($tokens[$nextToken]['type'] === 'T_CONSTANT_ENCAPSED_STRING') {
					$error = $tokens[$nextToken]['content'];
					$phpcsFile->addError($error, $stackPtr, 'LangUsageSniff');
				}

			}
		}
	}
}