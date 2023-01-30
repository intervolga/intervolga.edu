<?php
namespace Intervolga\Edu\Locator\Iblock\Property;

use Bitrix\Main\Localization\Loc;
use CIBlockProperty;
use Intervolga\Edu\Locator\Iblock\PromoIblock;
use Intervolga\Edu\Locator\Iblock\ResultsPollingIblock;

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
