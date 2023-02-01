<?php
namespace Intervolga\Edu\Locator\Iblock;

use Bitrix\Main\Localization\Loc;

class GalleryIblock extends IblockLocator
{
	public static function getFilter(): array
	{
		return [
			'=NAME' => [
				'Фотогалерея'
			],
		];
	}

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.IBLOCK_RESPONDENT');
	}
}