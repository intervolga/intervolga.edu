<?php
namespace Intervolga\Edu\Sniffer\Standards\Hermitage\Sniffs\PHP;

use PHP_CodeSniffer\Sniffs\Sniff;

class HermitageFoundSniff implements Sniff
{
	public function register()
	{
		return [T_STRING];
	}

	public function process(\PHP_CodeSniffer\Files\File $phpcsFile, $stackPtr)
	{
		$tokens = $phpcsFile->getTokens();
		$getArrayByID = $tokens[$stackPtr];

		if (preg_match('/GetArrayByID/mi', $getArrayByID['content'])) {
			$idVarName = $phpcsFile->findNext(T_CONSTANT_ENCAPSED_STRING, $stackPtr);
			if (preg_match('/IBLOCK_SECTION_ID/im', $tokens[$idVarName]['content'])) {
				$phpcsFile->addError('IBLOCK_SECTION_ID', $idVarName, 'HermitageFoundSniff');
			}
			if (preg_match('/IBLOCK_ID/im', $tokens[$idVarName]['content'])) {
				$phpcsFile->addError('IBLOCK_ID', $idVarName, 'HermitageFoundSniff');
			}
		}
	}
}