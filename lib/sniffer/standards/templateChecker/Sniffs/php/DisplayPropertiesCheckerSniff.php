<?php
namespace Intervolga\Edu\Sniffer\Standards\General\Sniffs\PHP;

use Bitrix\Main\IO\File;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Util\Admin;
use Intervolga\Edu\Util\FileSystem;
use Intervolga\Edu\Util\FileMessage;
use PHP_CodeSniffer\Sniffs\Sniff;

class DisplayPropertiesCheckerSniff implements Sniff
{
	public function register()
	{
		return [T_CONSTANT_ENCAPSED_STRING];
	}

	public function process(\PHP_CodeSniffer\Files\File $phpcsFile, $stackPtr)
	{
		$tokens = $phpcsFile->getTokens();
		$token = $tokens[$stackPtr];

		if (mb_strcut($token['content'], 1, -1) === 'PROPERTIES') {
			$file = new File($phpcsFile->getFilename());
			$error = Loc::getMessage('INTERVOLGA_EDU.SNIFFER_USE_PROPERTIES', [
				'#FILE#' => Loc::getMessage('INTERVOLGA_EDU.FSE', [
					'#NAME#' => $file->getName(),
					'#PATH#' => FileSystem::getLocalPath($file),
					'#FILEMAN_URL#' => Admin::getFileManUrl($file),
				]),
				'#CODE#' => $tokens[$phpcsFile->findNext(T_WHITESPACE, ($stackPtr + 3), null, true)]['content']
			]);
			$phpcsFile->addError($error, $stackPtr, 'DisplayPropertiesCheckerSniff');
		}

		if (in_array(mb_strcut($token['content'], 1, -1), [
			'PROPERTIES',
			'DISPLAY_PROPERTIES',

		])) {

			if (mb_strcut($tokens[$phpcsFile->findNext(T_WHITESPACE, ($stackPtr + 6), null, true)]['content'], 1, -1) === 'VALUE') {
				$file = new File($phpcsFile->getFilename());
				$error = Loc::getMessage('INTERVOLGA_EDU.SNIFFER_USE_DISPLAY_PROPERTIES', [
					'#FILE#' => FileMessage::get($file),
					'#CODE#' => $tokens[$phpcsFile->findNext(T_WHITESPACE, ($stackPtr + 3), null, true)]['content']
				]);
				$phpcsFile->addError($error, $stackPtr, 'DisplayPropertiesCheckerSniff');
			}
		}
	}
}