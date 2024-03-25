<?php
namespace PHP_CodeSniffer\Standards\EventhandlerClasses\Sniffs\PHP;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

class EventhandlerSniff implements Sniff
{
	public function register()
	{
		return [
			T_CONSTANT_ENCAPSED_STRING,
			T_STRING
		];
	}

	public function process(File $phpcsFile, $stackPtr)
	{
		$test = $phpcsFile->getFilename();
		$pos = strripos($test, '/');
		\Bitrix\Main\Diag\Debug::dump($pos);


		$str =  substr($test, $pos+1);

		if($str == 'main.php'){
			(new Main)->process($phpcsFile, $stackPtr);
		}

	}
}