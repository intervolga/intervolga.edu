<?php
namespace Intervolga\Edu\Sniffer\Standards\General\Sniffs\PHP;

use Bitrix\Main\IO\File;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Util\FileMessage;
use PHP_CodeSniffer\Sniffs\Sniff;

class FieldsCheckerSniff implements Sniff
{
	public function register()
	{
		return [T_CONSTANT_ENCAPSED_STRING];
	}

	public function process(\PHP_CodeSniffer\Files\File $phpcsFile, $stackPtr)
	{
		$tokens = $phpcsFile->getTokens();
		$token = $tokens[$stackPtr];

		if (in_array(mb_strcut($token['content'], 1, -1), [
			'PREVIEW_TEXT',
			'DETAIL_TEXT',
			'PREVIEW_PICTURE',
			'DETAIL_PICTURE',
			'NAME'
		])) {
			$prevToken = $phpcsFile->findPrevious(T_WHITESPACE, ($stackPtr - 1), null, true);
			if ($tokens[$prevToken]['type'] == 'T_OPEN_SQUARE_BRACKET') {
				$prevToken1 = $phpcsFile->findPrevious(T_WHITESPACE, ($prevToken - 1), null, true);
				if ($tokens[$prevToken1]['type'] === 'T_VARIABLE' && $tokens[$prevToken1]['content'] == '$arResult') {
					$file = new File($phpcsFile->getFilename());
					$error = Loc::getMessage('INTERVOLGA_EDU.SNIFFER_FIELDS', [
						'#FILE#' => FileMessage::get($file),
						'#CODE#' => $token['content']
					]);
					$phpcsFile->addError($error, $stackPtr, 'FieldsCheckerSniff');

				}
			}
		}
	}
}