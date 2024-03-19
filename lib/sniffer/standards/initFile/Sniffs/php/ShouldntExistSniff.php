<?php
namespace PHP_CodeSniffer\Standards\OldOrmClass\Sniffs\PHP;

use Bitrix\Main\Localization\Loc;
use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

class ShouldntExistSniff implements Sniff
{
	public function register()
	{
		return [T_CONSTANT_ENCAPSED_STRING, T_STRING];
	}

	public function process(File $phpcsFile, $stackPtr)
	{

		$tokens = $phpcsFile->getTokens();
		$finded = $phpcsFile->findNext(T_STRING, $stackPtr);

		foreach ($tokens as $token){
			var_dump($token['type'], 'type');
			echo '</br>';
			var_dump($token['content'], 'content');
			echo '</br>';
		}

		/*
		$method = $phpcsFile->findNext(T_STRING, $stackPtr);
		$methodName = $tokens[$method]['content'];

		switch ($methodName) {
			case 'Add':
				$this->checkAdd($phpcsFile, $stackPtr);
				break;
			case 'Update':
				$this->checkUpdate($phpcsFile, $stackPtr);
				break;
			default:
				return;
		}
		*/

	}
}