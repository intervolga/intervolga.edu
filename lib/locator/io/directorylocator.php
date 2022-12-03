<?php
namespace Intervolga\Edu\Locator\IO;

use Bitrix\Main\Application;
use Bitrix\Main\IO\Directory;

abstract class DirectoryLocator
{
	/**
	 * @return string[]
	 */
	abstract public static function getPaths(): array;

	abstract public static function getNameLoc(): string;

	/**
	 * @param Directory|string $class
	 * @return Directory|null
	 */
	public static function find($class = Directory::class)
	{
		$result = null;
		foreach (static::getPaths() as $path) {
			$directory = new $class(Application::getDocumentRoot() . $path);
			if ($directory->isExists() && $directory->isDirectory())
			{
				$result = $directory;
			}
		}

		return $result;
	}
}
