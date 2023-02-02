<?php
namespace Intervolga\Edu\Locator\IO;

use Bitrix\Main\Application;
use Bitrix\Main\IO\Directory;
use Intervolga\Edu\Locator\BaseLocator;
use Intervolga\Edu\Util\Admin;
use Intervolga\Edu\Util\FileMessage;
use Intervolga\Edu\Util\FileSystem;

abstract class DirectoryLocator extends BaseLocator
{
	/**
	 * @return string[]
	 */
	abstract protected static function getPaths(): array;

	/**
	 * @param Directory|string $class
	 * @return Directory|null
	 */
	public static function find($class = Directory::class)
	{
		$result = null;
		foreach (static::getPaths() as $path) {
			$directory = new $class(Application::getDocumentRoot() . $path);
			if ($directory->isExists() && $directory->isDirectory()) {
				$result = $directory;
			}
		}

		return $result;
	}

	/**
	 * @return string
	 */
	public static function getPossibleTips()
	{
		$result = [];
		$paths = static::getPaths();
		foreach ($paths as $path) {
			$result[] = FileMessage::get(FileSystem::getDirectory($path));
		}

		return implode('||', $result);
	}

	public static function getDisplayText($find): string
	{
		return FileSystem::getLocalPath($find);
	}

	public static function getDisplayHref($find): string
	{
		return Admin::getFileManUrl($find);
	}
}
