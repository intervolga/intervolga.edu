<?php
namespace Intervolga\Edu\Sniffer\Standards\General\Sniffs\PHP;

use Bitrix\Main\IO\File;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Util\Admin;
use Intervolga\Edu\Util\FileMessage;
use Intervolga\Edu\Util\FileSystem;
use PHP_CodeSniffer\Sniffs\Sniff;

class CheckCustomCoreSniff implements Sniff
{
	public function register()
	{
		return [T_CONSTANT_ENCAPSED_STRING];
	}

	public function process(\PHP_CodeSniffer\Files\File $phpcsFile, $stackPtr)
	{
		$tokens = $phpcsFile->getTokens();
		$token = $tokens[$stackPtr];

		foreach ($tokens as $contentToken) {
			if ($contentToken['type'] == 'T_CONSTANT_ENCAPSED_STRING' || $contentToken['type'] == 'T_STRING') {
				$contents[] = $contentToken['content'];
			}
		}

		if (!in_array('B_PROLOG_INCLUDED', $contents)) {
			$erorrs = $phpcsFile->getErrors();
			foreach ($erorrs as $rows) {
				foreach ($rows as $row) {
					foreach ($row as $error) {
						$errorSource[] = $error['source'];
					}
				}
			}

			if (!in_array('General.PHP.CheckCustomCore.A2CheckCustomCoreSniffNotFoundPrologIncluded', $errorSource)) {
				$file = new File($phpcsFile->getFilename());
				$error = Loc::getMessage('INTERVOLGA_EDU.SNIFFER_CUSTOM_CORE_NOT_FOUND', [
					'#FILE#' => FileMessage::getFileMessage([
						'#FILEMAN_URL#' => Admin::getFileManUrl($file),
						'#NAME#' => $file->getName(),
						'#FULL_PATH#' => str_replace($file->getName(), '', FileSystem::getLocalPath($file)),
					]),
				]);
				$phpcsFile->addError($error, $stackPtr, 'A2CheckCustomCoreSniffNotFoundPrologIncluded');
			}
		}

		if (preg_match('/B_PROLOG_INCLUDED/mi', $token['content'])) {
			$prevToken = $phpcsFile->findPrevious(T_WHITESPACE, ($stackPtr - 1), null, true);
			if ($tokens[$prevToken]['type'] == 'T_OPEN_PARENTHESIS') {
				$prevTokenDefine = $phpcsFile->findPrevious(T_WHITESPACE, ($prevToken - 1), null, true);
				if (strtolower($tokens[$prevTokenDefine]['content']) == 'defined') {
					$file = new File($phpcsFile->getFilename());
					$error = Loc::getMessage('INTERVOLGA_EDU.SNIFFER_CUSTOM_CORE', [
						'#FILE#' => FileMessage::getFileMessage([
							'#NAME#' => $file->getName(),
							'#FILEMAN_URL#' => Admin::getFileManUrl($file),
							'#FULL_PATH#' => str_replace($file->getName(), '', FileSystem::getLocalPath($file)),
						]),
					]);
					$phpcsFile->addError($error, $stackPtr, 'A1CheckCustomCoreSniff');
				}
			}
		}
	}
}