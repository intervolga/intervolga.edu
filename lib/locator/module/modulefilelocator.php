<?php
namespace Intervolga\Edu\Locator\Module;

use Bitrix\Main\IO\File;
use Intervolga\Edu\Locator\BaseLocator;
use Intervolga\Edu\Locator\IO\CustomModule;
use Intervolga\Edu\Util\FileMessage;
use Intervolga\Edu\Util\FileSystem;

abstract class ModuleFileLocator extends BaseLocator
{
	/**
	 * @return string
	 */
	public static function getPossibleTips()
	{
		$result = [];
		if ($module = CustomModule::find()) {
			$paths = static::getPaths();
			foreach ($paths as $path) {
				$result[] = FileMessage::get(FileSystem::getFile($module->getPath() . $path));
			}
		}

		return implode('||', $result);
	}

	/**
	 * @param File|string $class
	 * @return File|null
	 */
	public static function find($class = File::class)
	{
		$result = null;
		if ($module = CustomModule::find()) {
			foreach (static::getPaths() as $path) {
				$file = new $class($module->getPath() . $path);
				if ($file->isExists() && $file->isFile()) {
					$result = $file;
				}
			}
		}

		return $result;
	}

	/**
	 * @return string[]
	 */
	abstract protected static function getPaths(): array;

	public static function getDisplayText($find): string
	{
		return FileSystem::getLocalPath($find);
	}

	public static function getSelfModuleName(): string
	{
		$result = '';
		if ($module = CustomModule::find()) {
			$result = str_replace('intervolga.', '', $module->getName());
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
}
