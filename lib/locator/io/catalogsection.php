<?php
namespace Intervolga\Edu\Locator\IO;

use Bitrix\Main\Localization\Loc;

class CatalogSection extends DirectoryLocator
{
	protected static function getPaths(): array
	{
		return [
			'/catalog/'
		];
	}

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.CATALOG_DIRECTORY');
	}
}
