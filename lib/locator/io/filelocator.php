<?php
namespace Intervolga\Edu\Locator\IO;

use Bitrix\Main\Application;
use Bitrix\Main\IO\File;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Util\Admin;
use Intervolga\Edu\Util\FileSystem;

abstract class FileLocator
{
	/**
	 * @return string[]
	 */
	abstract protected static function getPaths(): array;

	abstract public static function getNameLoc(): string;

	/**
	 * @param File|string $class
	 * @return File|null
	 */
	public static function find($class = File::class)
	{
		$result = null;
		foreach (static::getPaths() as $path) {
			$file = new $class(Application::getDocumentRoot() . $path);
			if ($file->isExists() && $file->isFile())
			{
				$result = $file;
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
			$links[] = Loc::getMessage('INTERVOLGA_EDU.FSE', [
				'#NAME#' => FileSystem::getDirectory($path)->getName(),
				'#PATH#' => $path,
				'#FILEMAN_URL#' => Admin::getFileManUrl(FileSystem::getDirectory($path)),
			]);
		}

		return implode('||', $result);
	}
}
