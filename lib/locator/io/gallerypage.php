<?php

namespace Intervolga\Edu\Locator\IO;

use Bitrix\Main\Localization\Loc;

class GalleryPage extends FileLocator
{
	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.GALLERY_PAGE');
	}

	protected static function getPaths(): array
	{
		return [
			'/gallery.php',
			'/company/gallery.php',
		];
	}
}