<?php
namespace Intervolga\Edu\Sniffer\Standards\General\Sniffs\PHP;

use Bitrix\Main\IO\File;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Util\FileMessage;
use PHP_CodeSniffer\Sniffs\Sniff;

class UglyCodeFragmentsSniff implements Sniff
{
	public function register()
	{
		return [T_EMPTY];
	}

	public function process(\PHP_CodeSniffer\Files\File $phpcsFile, $stackPtr)
	{
		$tokens = $phpcsFile->getTokens();
		$token = $tokens[$stackPtr];

		$nextToken = $phpcsFile->findNext(T_WHITESPACE, ($stackPtr + 1), null, true);
		if ($tokens[$nextToken]['type'] === 'T_OPEN_PARENTHESIS') {
			$nextToken = $phpcsFile->findNext(T_WHITESPACE, ($nextToken + 1), null, true);
			if($tokens[$nextToken]['type'] === 'T_VARIABLE' && $tokens[$nextToken]['content'] === '$arResult'){
				$file = new File($phpcsFile->getFilename());
				$error = Loc::getMessage('INTERVOLGA_EDU.SNIFFER_UGLY_CODE_FRAGMENTS', [
					'#FILE#' => FileMessage::get($file),
				]);
				$phpcsFile->addError($error, $stackPtr, 'UglyCodeFragmentsSniff');
			}
		}
	}
}