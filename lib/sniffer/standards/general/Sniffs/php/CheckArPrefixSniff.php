<?php
namespace Intervolga\Edu\Sniffer\Standards\General\Sniffs\PHP;

use Bitrix\Main\Localization\Loc;
use PHP_CodeSniffer\Sniffs\Sniff;

Loc::loadMessages(__FILE__);

class CheckArPrefixSniff implements Sniff
{
	protected static $exceptionsNames = [
		'$arResult',
		'$arParams',
		'$arWizardVersion',
		'$arWizardDescription',
	];

	public function register()
	{
		return [T_VARIABLE];
	}

	public function process(\PHP_CodeSniffer\Files\File $phpcsFile, $stackPtr)
	{
		$tokens = $phpcsFile->getTokens();
		$token = $tokens[$stackPtr];

		if (preg_match('/\$ar.+/', $token['content'])) {
			if (!in_array($token['content'], static::$exceptionsNames)) {
				$error = Loc::getMessage('INTERVOLGA_EDU.AR_PREFIX_VAR', ['#VAR#' => $token['content']]);
				$phpcsFile->addError($error, $stackPtr, 'A1CheckArPrefix');
			}
		}
	}
}