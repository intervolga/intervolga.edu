<?php

namespace Intervolga\Edu\Sniffer\Standards\General\Sniffs\PHP;

use Bitrix\Main\Localization\Loc;
use PHP_CodeSniffer\Sniffs\Sniff;

Loc::loadMessages(__FILE__);

class CheckCourse3Lesson3Task3TestComponentSniff implements Sniff
{
	public function register()
	{
		return [T_STRING];
	}

	public function process(\PHP_CodeSniffer\Files\File $phpcsFile, $stackPtr)
	{
		$token = $phpcsFile->getToken($stackPtr);
		if (preg_match('/subquery/i', $token['content'])) {
			$msg = 'Was found';
			$phpcsFile->addError($msg, $stackPtr, 'CheckCourse3Lesson3Task3TestComponentSniff');
		}
	}
}
