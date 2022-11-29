<?php
namespace Intervolga\Edu\Util;

use Bitrix\Main\Application;
use Bitrix\Main\IO\Directory;
use Bitrix\Main\IO\File;
use Bitrix\Main\IO\FileSystemEntry;

class FileSystem
{
	const NON_PUBLIC_DIRS = [
		'/upload/',
		'/bitrix/',
		'/local/',
	];

	public static function getDirectory(string $localPath): Directory
	{
		return new Directory(Application::getDocumentRoot() . $localPath);
	}

	public static function getFile(string $localPath): File
	{
		return new File(Application::getDocumentRoot() . $localPath);
	}

	public static function getLocalPath(FileSystemEntry $entry): string
	{
		$path = str_replace(Application::getDocumentRoot(), '', $entry->getPath());
		if ($entry->isDirectory()) {
			$path .= '/';
		}

		return $path;
	}
}
