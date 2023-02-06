<?php

namespace Intervolga\Edu\Locator\IO;

use Bitrix\Main\Application;
use Bitrix\Main\IO\Directory;

class Gadgets extends DirectoryLocator
{
	public static function getNameLoc(): string
	{
		return 'gadgets';
	}

	/**
	 * @param Directory|string $class
	 * @return Directory|null
	 */
	public static function find($class = Directory::class)
	{
		$result = null;
		$rootLocalPath = static::getRootLocalPath();
		foreach (static::getPaths() as $path) {
			$directory = new $class(Application::getDocumentRoot() . $rootLocalPath . $path);
			if ($directory->isExists() && $directory->isDirectory()) {
				$gadget = $directory->getChildren()[0];
				if ($gadget->isExists() && $gadget->isDirectory()) {
					$result = $gadget;
				}
			}
		}

		return $result;
	}

	protected static function getPaths(): array
	{
		return [
			'/local/gadgets/custom/'
		];
	}
}