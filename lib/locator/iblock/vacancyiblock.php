<?php
namespace Intervolga\Edu\Locator\Iblock;

use Bitrix\Main\Localization\Loc;

class VacancyIblock extends IblockLocator
{
	public static function getFilter(): array
	{
		return [
			'=CODE' => [
				'vacancy',
				'vacancies',
				'furniture_vacancies_s1'
			],
		];
	}

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.IBLOCK_VACANCY');
	}
}