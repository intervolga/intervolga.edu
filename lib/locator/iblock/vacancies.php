<?php
namespace Intervolga\Edu\Locator\Iblock;

use Bitrix\Main\Localization\Loc;

class Vacancies extends IblockLocator
{
	public static function getFilter(): array
	{
		return [
			'=CODE' => [
				'vacancies',
				'vacancy'
			],
		];
	}

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.IBLOCK_VACANCIES');
	}
}