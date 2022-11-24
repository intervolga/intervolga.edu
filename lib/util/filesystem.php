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
			if (strlen($resultPath)) {
				$result [] = new File(Application::getDocumentRoot() . $resultPath);
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
		return str_replace(Application::getDocumentRoot(), '', $entry->getPath());
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
	 * @param Directory[] $dirs
	 * @param string $namePart
	 * @return File[]
	 */
	public static function getFilesRecursiveByNameSubst($dirs, $namePart)
	{
		return static::getFilesByNameSubst($dirs, $namePart, true);
	}

	/**
	 * @param Directory[] $dirs
	 * @param string $namePart
	 * @return File[]
	 */
	public static function getFilesNonRecursiveByNameSubst($dirs, $namePart)
	{
		return static::getFilesByNameSubst($dirs, $namePart, false);
	}

	/**
	 * @param Directory[] $dirs
	 * @param string $namePart
	 * @param bool $isRecursive
	 * @return File[]
	 */
	protected static function getFilesByNameSubst($dirs, $namePart, $isRecursive)
	{
		$dirsToCheck = [];
		$result = [];
		foreach ($dirs as $dir) {
			foreach ($dir->getChildren() as $child) {
				if ($child->isDirectory()) {
					if ($isRecursive) {
						$dirsToCheck[] = $child;
					}
				} else {
					if (substr_count($child->getName(), $namePart)) {
						$result[] = $child;
					}
				}
			}
		}
		if ($dirsToCheck) {
			$result = array_merge($result, static::getFilesByNameSubst($dirsToCheck, $namePart, $isRecursive));
		}

		return $result;
	}
}
