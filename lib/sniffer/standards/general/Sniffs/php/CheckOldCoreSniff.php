<?php
namespace Intervolga\Edu\Sniffer\Standards\General\Sniffs\PHP;

use Bitrix\Main\IO\File;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Util\Admin;
use Intervolga\Edu\Util\FileSystem;
use Intervolga\Edu\Util\FileMessage;
use PHP_CodeSniffer\Sniffs\Sniff;

class CheckOldCoreSniff implements Sniff
{
	public function register()
	{
		return [T_STRING];
	}

	public function process(\PHP_CodeSniffer\Files\File $phpcsFile, $stackPtr)
	{
		$tokens = $phpcsFile->getTokens();
		$token = $tokens[$stackPtr];

		if (preg_match('/SetAdditionalCSS/mi', $token['content'])) {
			$file = new File($phpcsFile->getFilename());
			$error = Loc::getMessage('INTERVOLGA_EDU.SNIFFER_SET_ADDITIONAL_CSS', [
				'#FILE#' => FileMessage::get($file),
				'#VAR#' => $token['content']
			]);
			$phpcsFile->addError($error, $stackPtr, 'A1CheckOldCoreSniff');
		}
		if (preg_match('/AddHeadScript/mi', $token['content'])) {
			$file = new File($phpcsFile->getFilename());
			$error = Loc::getMessage('INTERVOLGA_EDU.SNIFFER_SET_ADDITIONAL_CSS', [
				'#FILE#' => FileMessage::get($file),
				'#VAR#' => $token['content']
			]);
			$phpcsFile->addError($error, $stackPtr, 'A2CheckOldCoreSniff');
		}

		if (preg_match('/IncludeTemplateLangFile/mi', $token['content'])) {
			$file = new File($phpcsFile->getFilename());
			$error = Loc::getMessage('INTERVOLGA_EDU.SNIFFER_SET_ADDITIONAL_CSS', [
				'#FILE#' => FileMessage::get($file),
				'#VAR#' => $token['content']
			]);
			$phpcsFile->addError($error, $stackPtr, 'A3CheckOldCoreSniff');
		}

		if (preg_match('/getMessage/mi', $token['content'])) {
			$prevToken = $phpcsFile->findPrevious(T_WHITESPACE, ($stackPtr - 1), null, true);
			if ($tokens[$prevToken]['content'] !== '::') {
				$file = new File($phpcsFile->getFilename());
				$error = Loc::getMessage('INTERVOLGA_EDU.SNIFFER_SET_ADDITIONAL_CSS', [
					'#FILE#' => FileMessage::get($file),
					'#VAR#' => $token['content']
				]);
				$phpcsFile->addError($error, $stackPtr, 'A4CheckOldCoreSniff');
			}
		}

		if (preg_match('/CModule/mi', $token['content'])) {
			$nextToken = $phpcsFile->findNext(T_WHITESPACE, ($stackPtr + 1), null, true);
			if ($tokens[$nextToken]['type'] === 'T_DOUBLE_COLON') {
				$newNextToken = $phpcsFile->findNext(T_WHITESPACE, ($nextToken + 1), null, true);
				if (preg_match('/IncludeModule/mi', $tokens[$newNextToken]['content'])) {
					$file = new File($phpcsFile->getFilename());
					$error = Loc::getMessage('INTERVOLGA_EDU.SNIFFER_SET_ADDITIONAL_CSS', [
						'#FILE#' => FileMessage::get($file),
						'#VAR#' => $token['content'] . $tokens[$nextToken]['content'] . $tokens[$newNextToken]['content']
					]);
					$phpcsFile->addError($error, $stackPtr, 'A5CheckOldCoreSniff');
				}
			}
		}
	}
}