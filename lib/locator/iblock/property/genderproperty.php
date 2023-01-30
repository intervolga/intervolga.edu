<?php
namespace Intervolga\Edu\Locator\Iblock\Property;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Locator\Iblock\ResultsPollingIblock;

Loc::loadMessages(__FILE__);

class GenderProperty extends PropertyLocator
{
	public static function getIblock()
	{
		return ResultsPollingIblock::class;
	}

	public static function getFilter(): array
	{
		return [
			'=CODE' => [
				'GENDER',
				'SEX'
			],
			'PROPERTY_TYPE' => [
				'L'
			]
		];
	}

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.GENDER_PROPERTY');
	}
}
