<?php
namespace Intervolga\Edu\Util\Registry\Directory;

use Bitrix\Main\Application;
use Bitrix\Main\IO\Directory;

abstract class BaseDirectory
{
	/**
	 * @return string[]
	 */
	abstract public static function getPaths(): array;

	abstract public static function getName(): string;

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
