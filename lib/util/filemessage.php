<?php
namespace Intervolga\Edu\Util;

use Bitrix\Main\IO\FileSystemEntry;
use Bitrix\Main\Localization\Loc;

class FileMessage
{
	public static function get(FileSystemEntry $fse, int $line = 0, int $column = 0): string
	{
		$coords = '';
		if ($line) {
			if ($column) {
				$coords = Loc::getMessage('INTERVOLGA_EDU.FSE_MESSAGE_COORDS_LINE_COLUMN', [
					'#LINE#' => $line,
					'#COLUMN#' => $column,
				]);
			}
			else
			{
				$coords = Loc::getMessage('INTERVOLGA_EDU.FSE_MESSAGE_COORDS_LINE', [
					'#LINE#' => $line,
				]);
			}
		}
		$fullPath = FileSystem::getLocalPath($fse);
		$replace = [
			'#FULL_PATH#' => $fullPath,
			'#PATH_START#' => FileSystem::getLocalPath($fse->getDirectory()),
			'#NAME#' => $fse->getName(),
			'#PATH_END#' => $fse->isDirectory() ? '/' : '',
			'#FILEMAN_URL#' => Admin::getFileManUrl($fse),
			'#COORDS#' => $coords,
		];
		$message = Loc::getMessage('INTERVOLGA_EDU.FSE_MESSAGE', $replace);

		return $message;
	}
}