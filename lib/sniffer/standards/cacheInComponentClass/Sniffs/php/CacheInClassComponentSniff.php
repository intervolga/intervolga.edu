<?php
namespace Intervolga\Edu\Sniffer\Standards\CacheInComponentClass\Sniffs\PHP;

use Bitrix\Main\Localization\Loc;
use PHP_CodeSniffer\Sniffs\Sniff;

Loc::loadMessages(__FILE__);

class CacheInClassComponentSniff implements Sniff
{
	public function register()
	{
		return [
			T_STRING,
			T_CONSTANT_ENCAPSED_STRING
		];
	}

	public function process(\PHP_CodeSniffer\Files\File $phpcsFile, $stackPtr)
	{
		$tokens = $phpcsFile->getTokens();
		$token = $tokens[$stackPtr];

		if (preg_match('/CACHE_TIME/i', $token['content'])) {
			$error = $token['content'];
			$phpcsFile->addError($error, $stackPtr, 'CacheInParametersSniff');
		}
		if (preg_match('/StartResultCache/i', $token['content'])) {
			$error = $token['content'];
			$phpcsFile->addError($error, $stackPtr, 'CacheInParametersSniff');
		}
	}
}