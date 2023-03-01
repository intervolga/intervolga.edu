<?php
namespace Intervolga\Edu\Locator;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Util\FileMessage;
use Intervolga\Edu\Util\FileSystem;

abstract class BaseLocator
{
	abstract public static function getDisplayText($find): string;

	abstract public static function getNameLoc(): string;

	protected static function getDisplayHref($find): string
	{
		return '';
	}

	/**
	 * @return string
	 */
	protected static function getFoundDirectoryPath($find)
	{
		return '';
	}

	/**
	 * @return string
	 */
	protected static function getFoundFilePath($find)
	{
		return '';
	}

	/**
	 * @param string|static $parentLocator
	 * @param $found
	 * @return string
	 */
	public static function getReport($parentLocator, $found): string
	{
		$parentLocatorName = str_replace('Intervolga\Edu\Locator\\', '', $parentLocator);
		$pathDir = static::getFoundDirectoryPath($found);
		if (strlen($pathDir)) {
			return Loc::getMessage('INTERVOLGA_EDU.LOCATOR_FOUND_DIRECTORY', [
				'#LOCATOR#' => $parentLocatorName,
				'#NAME#' => static::getNameLoc(),
				'#DIRECTORY#' => FileMessage::get(FileSystem::getDirectory($pathDir)),
				'#TIP#' => static::getDisplayText($found),
			]);
		}

		$pathFile = static::getFoundFilePath($found);
		if (strlen($pathFile)) {
			return Loc::getMessage('INTERVOLGA_EDU.LOCATOR_FOUND_FILE', [
				'#LOCATOR#' => $parentLocatorName,
				'#NAME#' => static::getNameLoc(),
				'#FILE#' => FileMessage::get(FileSystem::getFile($pathFile)),
				'#TIP#' => static::getDisplayText($found),
			]);
		}

		$href = static::getDisplayHref($found);
		if (strlen($href)) {
			return Loc::getMessage('INTERVOLGA_EDU.LOCATOR_FOUND_HREF', [
				'#LOCATOR#' => $parentLocatorName,
				'#NAME#' => static::getNameLoc(),
				'#HREF#' => $href,
				'#TIP#' => static::getDisplayText($found),
			]);
		}

		return Loc::getMessage('INTERVOLGA_EDU.LOCATOR_FOUND', [
			'#LOCATOR#' => $parentLocatorName,
			'#NAME#' => static::getNameLoc(),
			'#TIP#' => static::getDisplayText($found),
		]);
	}
}