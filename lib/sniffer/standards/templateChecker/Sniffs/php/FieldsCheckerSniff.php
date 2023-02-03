<?php
namespace Intervolga\Edu\Sniffer\Standards\General\Sniffs\PHP;

use Bitrix\Main\IO\File;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Util\Admin;
use Intervolga\Edu\Util\FileSystem;
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

			if (mb_strcut($tokens[$phpcsFile->findPrevious(T_WHITESPACE, ($stackPtr - 3), null, true)]['content'], 1, -1) !== 'FIELDS') {
				$file = new File($phpcsFile->getFilename());
				$error = Loc::getMessage('INTERVOLGA_EDU.SNIFFER_FIELDS', [
					'#FILE#' => Loc::getMessage('INTERVOLGA_EDU.FSE', [
						'#NAME#' => $file->getName(),
						'#PATH#' => FileSystem::getLocalPath($file),
						'#FILEMAN_URL#' => Admin::getFileManUrl($file),
					]),
					'#CODE#' => $token['content']
				]);
				$phpcsFile->addError($error, $stackPtr, 'FieldsCheckerSniff');
			}
		}
	}
}