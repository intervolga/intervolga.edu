<?php
namespace Intervolga\Edu\Locator\IO;

use Bitrix\Main\Application;
use Bitrix\Main\IO\File;
use Intervolga\Edu\Locator\BaseLocator;
use Intervolga\Edu\Util\FileMessage;
use Intervolga\Edu\Util\FileSystem;

abstract class FileLocator extends BaseLocator
{
	/**
	 * @return string[]
	 */
	abstract protected static function getPaths(): array;

	/**
	 * @param File|string $class
	 * @return File|null
	 */
	public static function find($class = File::class)
	{
		$result = null;
		foreach (static::getPaths() as $path) {
			$file = new $class(Application::getDocumentRoot() . $path);
			if ($file->isExists() && $file->isFile()) {
				$result = $file;
			}
		}

		return $result;
	}

	/**
	 * @param File|null $find
	 * @return string
	 */
	protected static function getFoundFilePath($find)
	{
		if ($find) {
			return $find->getPath();
		} else {
			return '';
		}
	}

	/**
	 * @return string
	 */
	public static function getPossibleTips()
	{
		$result = [];
		$paths = static::getPaths();
		foreach ($paths as $path) {
			$result[] = FileMessage::get(FileSystem::getFile($path));
		}

		return implode('||', $result);
	}

	public static function getDisplayText($find): string
	{
		return FileSystem::getLocalPath($find);
	}
}
