<?php
namespace Intervolga\Edu\Locator\Iblock\Property;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Locator\Iblock\ResultsPollingIblock;

Loc::loadMessages(__FILE__);

class SalaryProperty extends PropertyLocator
{
	public static function getIblock()
	{
		return ResultsPollingIblock::class;
	}

	public static function getFilter(): array
	{
		return [
			'=CODE' => [
				'SALARY',
			],
			'PROPERTY_TYPE' => [
				'N'
			]
		];
	}

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.SALARY_PROPERTY');
	}
}
