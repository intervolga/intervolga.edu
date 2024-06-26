<?php
namespace Intervolga\Edu\Sniffer\Standards\WasteInitChecker\Sniffs\PHP;

use Bitrix\Main\Localization\Loc;
use PHP_CodeSniffer\Sniffs\Sniff;

class FindWasteSniff implements Sniff
{
	public function register()
	{
		return [T_INLINE_HTML];
	}

	public function process(\PHP_CodeSniffer\Files\File $phpcsFile, $stackPtr)
	{
		$tokens = $phpcsFile->getTokens();
		$token = $tokens[$stackPtr];

		if ($token) {
			$error = Loc::getMessage('INTERVOLGA_EDU.SNIFFER_FIND_WASTE_HTML_LINE', [
				'#VAR#' => $token['content']
			]);
			$phpcsFile->addError($error, $stackPtr, 'FindWasteSniff');
		}
	}
}