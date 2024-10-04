<?php
namespace Intervolga\Edu\Locator\Iblock\Property;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Locator\Iblock\VacancyIblock;

class WorkTimeProperty extends PropertyLocator
{
	public static function getIblock()
	{
		return VacancyIblock::class;
	}

	public static function getFilter(): array
	{
		return [
			'=CODE' => [
				'WORK_TIME',
				'WORKING_TIME'
			],
		];
	}

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.WORK_TIME_PROPERTY');
	}
}
