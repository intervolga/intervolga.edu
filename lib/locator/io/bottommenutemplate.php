<?php
namespace Intervolga\Edu\Locator\IO;

use Bitrix\Main\Localization\Loc;

class BottomMenuTemplate extends DirectoryLocator
{
	protected static function getPaths(): array
	{
		return [
			'/local/templates/.default/components/bitrix/menu/about_store/',
			'/local/templates/.default/components/bitrix/menu/about/',
			'/local/templates/.default/components/bitrix/menu/bottom/',
		];
	}

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.BOTTOM_MENU_TEMPLATE');
	}
}
