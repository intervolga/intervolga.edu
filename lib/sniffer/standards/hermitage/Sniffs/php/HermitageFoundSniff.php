<?php
namespace Intervolga\Edu\Sniffer\Standards\Hermitage\Sniffs\PHP;

use PHP_CodeSniffer\Sniffs\Sniff;

class HermitageFoundSniff implements Sniff
{
	const error = [];

	public function register()
	{
		return [T_STRING];
	}

	public function process(\PHP_CodeSniffer\Files\File $phpcsFile, $stackPtr)
	{
		$tokens = $phpcsFile->getTokens();
		$getArrayByID = $tokens[$stackPtr];

		if ($getArrayByID['content'] === 'GetArrayByID') {
			$error = '';
			$idVarName = $phpcsFile->findNext(T_CONSTANT_ENCAPSED_STRING, $stackPtr);
			if (preg_match('/IBLOCK_SECTION_ID/i', $tokens[$idVarName]['content'])) {

				$error .= 'IBLOCK_SECTION_ID';
				$phpcsFile->addError('IBLOCK_SECTION_ID', $idVarName, 'HermitageFoundSniff');
			}
			if (preg_match('/IBLOCK_ID/i', $tokens[$idVarName]['content'])) {
				$error .= 'IBLOCK_ID';
				$phpcsFile->addError('IBLOCK_ID', $idVarName, 'HermitageFoundSniff');
			}

		}
	}
}