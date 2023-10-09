<?php
namespace Intervolga\Edu\Sniffer\Standards\General\Sniffs\PHP;

use Bitrix\Main\IO\File;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Util\FileMessage;
use PHP_CodeSniffer\Sniffs\Sniff;

class CommentPhpCodeSniff implements Sniff
{
	public function register()
	{
		return [T_COMMENT];
	}

	public function process(\PHP_CodeSniffer\Files\File $phpcsFile, $stackPtr)
	{
		$tokens = $phpcsFile->getTokens();
		$token = $tokens[$stackPtr];

		if (preg_match('/\/\*/', $token['content'])) {

			$erorrs = $phpcsFile->getErrors();
			foreach ($erorrs as $rows) {
				foreach ($rows as $row) {
					foreach ($row as $error) {
						$errorSource[] = $error['source'];
					}
				}
			}

			if (!in_array('General.PHP.CheckCustomCore.CommentPhpCodeSniff', $errorSource)) {
				while (!preg_match('/\*\//', $tokens[$stackPtr]['content'])) {
					$commentPhp[] = $tokens[$stackPtr]['content'];
					$stackPtr++;
				}
				$commentPhp = implode("<br/>", $commentPhp) . '*/';

				$file = new File($phpcsFile->getFilename());
				$error = Loc::getMessage('INTERVOLGA_EDU.SNIFFER_COMMENT_PHP_CODE', [
					'#FILE#' => FileMessage::get($file),
					'#VALUE#' => $commentPhp,
				]);
				$phpcsFile->addError($error, $stackPtr, 'CommentPhpCodeSniff');
			}
		}

	}
}
