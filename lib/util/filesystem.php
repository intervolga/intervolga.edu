<?php
namespace Intervolga\Edu\Util;

use Bitrix\Main\Application;
use Bitrix\Main\IO\Directory;
use Bitrix\Main\IO\File;
use Bitrix\Main\IO\FileSystemEntry;

class FileSystem
{
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

	public static function getInnerDirectory(Directory $directory, string $innerDirectoryName): Directory
	{
		return new Directory($directory->getPath() . '/' . $innerDirectoryName . '/');
	}

	public static function getInnerFile(Directory $directory, string $innerFileName): File
	{
		return new File($directory->getPath() . '/' . $innerFileName);
	}

	/**
	 * @param FileSystemEntry $fileSystemEntry1
	 * @param FileSystemEntry $fileSystemEntry2
	 * @return bool
	 */
	public static function isSame(FileSystemEntry $fileSystemEntry1, FileSystemEntry $fileSystemEntry2): bool
	{
		$sameTypes = ($fileSystemEntry1->isFile() == $fileSystemEntry2->isFile());
		$sameNames = $fileSystemEntry1->getPath() == $fileSystemEntry2->getPath();
		return $sameNames && $sameTypes;

	}
}
