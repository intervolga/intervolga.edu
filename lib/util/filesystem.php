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

	/**
	 * @param $path
	 * @return Directory
	 */
	public static function getDirectory($path)
	{
		return new Directory(Application::getDocumentRoot() . $path);
	}

	/**
	 * @param array $partsToCombo
	 * @return FileSystemEntry[]
	 */
	public static function getComboEntries(array $partsToCombo)
	{
		$result = [];
		$resultPaths = [''];
		foreach ($partsToCombo as $partToCombo) {
			if (is_array($partToCombo)) {
				$newResult = [];
				foreach ($partToCombo as $subPartToCombo) {
					foreach ($resultPaths as $item) {
						$newResult[] = $item . $subPartToCombo;
					}
				}
				$resultPaths = $newResult;
			} else {
				foreach ($resultPaths as $i => $item) {
					$resultPaths[$i] .= $partToCombo;
				}
			}
		}

		foreach ($resultPaths as $resultPath) {
			if (mb_strlen($resultPath)) {
				if (mb_substr($resultPath, '-1', '1') == '/') {
					$result [] = new Directory(Application::getDocumentRoot() . $resultPath);
				} else {
					$result [] = new File(Application::getDocumentRoot() . $resultPath);
				}
			}
		}

		return $result;
	}

	/**
	 * @param FileSystemEntry $entry
	 * @return string
	 */
	public static function getLocalPath(FileSystemEntry $entry)
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
	 * @return File[]
	 */
	public static function getFilesNonRecursiveByPathRegex($dirs, $pathRegex)
	{
		return static::getFilesByPathRegex($dirs, $pathRegex, false);
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
