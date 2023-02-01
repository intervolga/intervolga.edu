<?php
namespace Intervolga\Edu\Locator\IO;

use Bitrix\Main\Application;
use Bitrix\Main\IO\Directory;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Locator\BaseLocator;
use Intervolga\Edu\Util\Admin;
use Intervolga\Edu\Util\FileSystem;

abstract class DirectoryLocator extends BaseLocator
{
	/**
	 * @return string[]
	 */
	abstract protected static function getPaths(): array;

	/**
	 * @return string|DirectoryLocator
	 */
	protected static function getRootLocator()
	{
	}

	/**
	 * @return string
	 */
	protected static function getRootLocalPath()
	{
		$rootPath = '';
		if ($rootLocator = static::getRootLocator()) {
			$rootDirectory = $rootLocator::find();
			if ($rootDirectory && $rootDirectory->isExists()) {
				$rootPath = FileSystem::getLocalPath($rootDirectory);
			}
		}

		return $rootPath;
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
		$rootLocalPath = static::getRootLocalPath();
		$paths = static::getPaths();
		foreach ($paths as $path) {
			$result[] = Loc::getMessage('INTERVOLGA_EDU.FSE', [
				'#NAME#' => FileSystem::getDirectory($rootLocalPath.$path)->getName(),
				'#PATH#' => $rootLocalPath.$path,
				'#FILEMAN_URL#' => Admin::getFileManUrl(FileSystem::getDirectory($rootLocalPath.$path)),
			]);
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
