<?php
namespace Intervolga\Edu\Locator\IO;

use Bitrix\Main\Localization\Loc;

class CatalogSectionTemplate extends DirectoryLocator
{

	protected static function getPaths(): array
	{
		return [
			'/local/templates/.default/components/bitrix/catalog.section/.default',
		];
	}

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.CATALOG_SECTION_TEMPLATE');
	}
}