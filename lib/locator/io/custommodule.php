<?php
namespace Intervolga\Edu\Locator\IO;

use Bitrix\Main\IO\Directory;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Util\Admin;
use Intervolga\Edu\Util\FileSystem;
use Intervolga\Edu\Util\PathMaskParser;

class CustomModule extends DirectoryLocator
{
	protected static function getKnownIntervolgaModules(): array
	{
		return [
			'intervolga.edu',
			'intervolga.common',
			'intervolga.migrato',
		];
	}

	protected static function getPaths(): array
	{
		return [];
	}

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.CUSTOM_MODULE');
	}

	/**
	 * @param Directory|string $class
	 * @return Directory|null
	 */
	public static function find($class = Directory::class)
	{
		$result = null;
		$modulesDirs = PathMaskParser::getFileSystemEntriesByMask('/local/modules/intervolga.*/');
		foreach ($modulesDirs as $moduleDir) {
			if (!in_array($moduleDir->getName(), static::getKnownIntervolgaModules())) {
				$result = new $class($moduleDir->getPath().'/');
			}
		}

		return $result;
	}

	public static function getPossibleTips()
	{
		return Loc::getMessage('INTERVOLGA_EDU.CUSTOM_MODULE_TIP', [
			'#MODULES#' => Loc::getMessage('INTERVOLGA_EDU.FSE', [
				'#NAME#' => 'modules',
				'#PATH#' => '/local/modules/',
				'#FILEMAN_URL#' => Admin::getFileManUrl(FileSystem::getDirectory('/local/modules/')),
			]),
		]);
	}
}
