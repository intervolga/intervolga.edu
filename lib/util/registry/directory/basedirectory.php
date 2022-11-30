<?php
namespace Intervolga\Edu\Util\Registry\Directory;

use Bitrix\Main\IO\Directory;
use Intervolga\Edu\Util\FileSystem;

abstract class BaseDirectory
{
	abstract public static function getPaths(): array;

	abstract public static function getName(): string;

	/**
	 * @return Directory|null
	 */
	public static function find()
	{
		$result = null;
		foreach (static::getPaths() as $path) {
			$directory = FileSystem::getDirectory($path);
			if ($directory->isExists() && $directory->isDirectory())
			{
				$result = $directory;
			}
		}

		return $result;
	}

	/**
	 * @return Directory[]
	 */
	public static function getPathObjects()
	{
		$result = [];
		foreach (static::getPaths() as $path) {
			$result[] = FileSystem::getDirectory($path);
		}

		return $result;
	}
}
