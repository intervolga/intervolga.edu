<?php
namespace Intervolga\Edu\Sniffer\Standards\General\Sniffs\PHP;

use Bitrix\Main\IO\File;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Util\FileMessage;
use PHP_CodeSniffer\Sniffs\Sniff;

class CommentHTMLSniff implements Sniff
{
	public function register()
	{
		return [T_INLINE_HTML];
	}

	public function process(\PHP_CodeSniffer\Files\File $phpcsFile, $stackPtr)
	{
		$tokens = $phpcsFile->getTokens();
		$token = $tokens[$stackPtr];

		if (preg_match('/\<!--/', $token['content'])) {

			$file = new File($phpcsFile->getFilename());
			$error = Loc::getMessage('INTERVOLGA_EDU.SNIFFER_COMMENT_HTML', [
				'#FILE#' => FileMessage::get($file),
				'#VALUE#' => str_replace('<', '&lt;', $token['content']),
			]);
			$phpcsFile->addError($error, $stackPtr, 'CommentHTMLSniff');
		}
	}
}
