<?php
namespace Intervolga\Edu\Util;

use Bitrix\Main\IO\FileSystemEntry;
use Bitrix\Main\Localization\Loc;

class FileMessage
{
	public static function get(FileSystemEntry $fse): string
	{
		$replace = [
			'#FULL_PATH#' => FileSystem::getLocalPath($fse),
			'#PATH_START#' => FileSystem::getLocalPath($fse->getDirectory()),
			'#NAME#' => $fse->getName(),
			'#PATH_END#' => $fse->isDirectory() ? '/' : '',
			'#FILEMAN_URL#' => Admin::getFileManUrl($fse),

		];
		echo '<pre>' . __FILE__ . ':' . __LINE__ . ':<br>' . print_r($replace, true) . '</pre>';
		$message = Loc::getMessage('INTERVOLGA_EDU.FSE_MESSAGE', $replace);
		echo '<pre>' . __FILE__ . ':' . __LINE__ . ':<br>' . print_r($message, true) . '</pre>';

		return $message;
	}
}