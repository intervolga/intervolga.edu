<?php
namespace Intervolga\Edu\Sniffer\Standards\General\Sniffs\PHP;

use Bitrix\Main\IO\File;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Util\Admin;
use Intervolga\Edu\Util\FileSystem;
use PHP_CodeSniffer\Sniffs\Sniff;

Loc::loadMessages(__FILE__);

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
				'#FILE#' => Loc::getMessage('INTERVOLGA_EDU.FSE', [
					'#NAME#' => $file->getName(),
					'#PATH#' => FileSystem::getLocalPath($file),
					'#FILEMAN_URL#' => Admin::getFileManUrl($file),
				]),
				'#VALUE#' => str_replace('<', '&lt;', $token['content']),
			]);
			$phpcsFile->addError($error, $stackPtr, 'CommentHTMLSniff');
		}
	}
}
