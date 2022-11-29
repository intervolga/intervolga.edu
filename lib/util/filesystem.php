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

	/**
	 * @return Directory[]
	 */
	public static function getPublicDirsLevelOne()
	{
		$result = [];
		$directory = new Directory(Application::getDocumentRoot());
		foreach ($directory->getChildren() as $child) {
			if ($child->isDirectory()) {
				if (!in_array('/' . $child->getName() . '/', static::NON_PUBLIC_DIRS)) {
					$result[] = $child;
				}
			}
		}

		return $result;
	}

	/**
	 * @param FileSystemEntry[] $dirs
	 * @param string $pathRegex
	 * @return File[]
	 */
	public static function getFilesRecursiveByPathRegex($dirs, $pathRegex)
	{
		return static::getFilesByPathRegex($dirs, $pathRegex, true);
	}

	/**
	 * @param Directory[] $dirs
	 * @param string $pathRegex
	 * @param bool $isRecursive
	 * @return File[]
	 */
	protected static function getFilesByPathRegex($dirs, $pathRegex, $isRecursive)
	{
		$dirsToCheck = [];
		$result = [];
		foreach ($dirs as $dir) {
			if ($dir->isExists()) {
				foreach ($dir->getChildren() as $child) {
					if ($child->isDirectory()) {
						if ($isRecursive) {
							$dirsToCheck[] = $child;
						}
					} else {
						preg_match_all($pathRegex, $child->getPath(), $matches, PREG_SET_ORDER, 0);

						if ($matches) {
							$result[] = $child;
						}
					}
				}
			}
		}
		if ($dirsToCheck) {
			$result = array_merge($result, static::getFilesByPathRegex($dirsToCheck, $pathRegex, $isRecursive));
		}

		return $result;
	}
}
