<?php
namespace Intervolga\Edu\Locator\IO\directory;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Locator\IO\DirectoryLocator;

class ImgDefaultTemplates extends DirectoryLocator
{
	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.DEFAULT_TEMPLATE_DIRECTORY_IMG');
	}

	/**
	 * @return string|DirectoryLocator
	 */
	protected static function getRootLocator()
	{
		return DefaultTemplates::class;
	}

	protected static function getPaths(): array
	{
		return [
			'/images/'
		];
	}
}