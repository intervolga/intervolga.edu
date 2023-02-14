<?php
namespace Intervolga\Edu\Locator\IO\ComponentTemplate;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Locator\IO\DirectoryLocator;

class GalleryTemplate extends DirectoryLocator
{
	protected static function getPaths(): array
	{
		return [
			'/local/templates/.default/components/bitrix/news.list/gallery/'
		];
	}

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.GALLERY_TEMPLATE');
	}
}
