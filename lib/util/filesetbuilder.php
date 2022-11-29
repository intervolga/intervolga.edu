<?php
namespace Intervolga\Edu\Util;

use Bitrix\Main\Application;
use Bitrix\Main\IO\Directory;
use Bitrix\Main\IO\FileNotFoundException;
use Bitrix\Main\IO\FileSystemEntry;

/**
 * @deprecated use FileSystem
 * @package Intervolga\Edu\Util
 */
class FilesetBuilder
{
	const NON_PUBLIC_DIRS = [
		'/upload/',
		'/bitrix/',
		'/local/',
	];

	public static function getRoot(): Directory
	{
		return new Directory(Application::getDocumentRoot());
	}

	/**
	 * @param bool $getDirs
	 * @param bool $getFiles
	 * @return FileSystemEntry[]
	 * @throws FileNotFoundException
	 */
	public static function getPublic(bool $getDirs = true, bool $getFiles = true): array
	{
		$result = [];
		foreach (static::getRoot()->getChildren() as $child) {
			if ($child->isDirectory()) {
				if (!in_array('/' . $child->getName() . '/', static::NON_PUBLIC_DIRS)) {
					$result = array_merge($result, static::getChildrenRecursive($child, $getDirs, $getFiles));
					if ($getDirs) {
						$result[] = $child;
					}
				}
			} elseif ($getFiles) {
				$result[] = $child;
			}
		}

		return $result;
	}

	/**
	 * @param Directory $root
	 * @param bool $getDirs
	 * @param bool $getFiles
	 * @return FileSystemEntry[]
	 * @throws FileNotFoundException
	 */
	protected static function getChildrenNonRecursive(Directory $root, bool $getDirs = true, bool $getFiles = true): array
	{
		$result = [];
		foreach ($root->getChildren() as $child) {
			if ($child->isDirectory()) {
				if ($getDirs) {
					$result[] = $child;
				}
			} elseif ($getFiles) {
				$result[] = $child;
			}
		}

		return $result;
	}

	/**
	 * @param Directory $root
	 * @param bool $getDirs
	 * @param bool $getFiles
	 * @return FileSystemEntry[]
	 * @throws FileNotFoundException
	 */
	protected static function getChildrenRecursive(Directory $root, bool $getDirs = true, bool $getFiles = true): array
	{
		$result = [];
		foreach ($root->getChildren() as $child) {
			if ($child->isDirectory()) {
				$result = array_merge($result, static::getChildrenRecursive($child, $getDirs, $getFiles));
				if ($getDirs) {
					$result[] = $child;
				}
			} elseif ($getFiles) {
				$result[] = $child;
			}
		}

		return $result;
	}
}
