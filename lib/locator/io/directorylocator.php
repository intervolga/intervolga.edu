<?php
namespace Intervolga\Edu\Locator\IO;

use Bitrix\Main\Application;
use Bitrix\Main\IO\Directory;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Util\Admin;
use Intervolga\Edu\Util\FileSystem;

abstract class DirectoryLocator
{
	/**
	 * @return string[]
	 */
	abstract protected static function getPaths(): array;

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

	/**
	 * @return string
	 */
	public static function getPossibleTips()
	{
		$result = [];
		$paths = static::getPaths();
		foreach ($paths as $path) {
			$result[] = Loc::getMessage('INTERVOLGA_EDU.FSE', [
				'#NAME#' => FileSystem::getDirectory($path)->getName(),
				'#PATH#' => $path,
				'#FILEMAN_URL#' => Admin::getFileManUrl(FileSystem::getDirectory($path)),
			]);
		}

		return implode('||', $result);
	}
}
