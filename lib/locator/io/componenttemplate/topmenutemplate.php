<?php
namespace Intervolga\Edu\Locator\IO\ComponentTemplate;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Locator\IO\DirectoryLocator;

class TopMenuTemplate extends DirectoryLocator
{
	protected static function getPaths(): array
	{
		return [
			'/local/templates/.default/components/bitrix/menu/top_multi/',
			'/local/templates/.default/components/bitrix/menu/top_multilvl/',
			'/local/templates/.default/components/bitrix/menu/top/',
		];
	}

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.TOP_MENU_TEMPLATE');
	}
}
