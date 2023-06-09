<?php
namespace Intervolga\Edu\Locator\Iblock\Property;

use Bitrix\Main\Localization\Loc;
use CIBlockProperty;
use Intervolga\Edu\Locator\Iblock\PromoIblock;

class PriceProperty extends PropertyLocator
{
	public static function getIblock()
	{
		return PromoIblock::class;
	}

	public static function getFilter(): array
	{
		return [
			'=CODE' => [
				'PRICE',
			],
			'PROPERTY_TYPE' => [
				'S'
			]
		];
	}

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.PRICE_PROPERTY');
	}

	public static function getPropertyParameters()
	{
		$result = CIBlockProperty::GetByID("PRICE", PromoIblock::find()['ID']);

		return $result->fetch();
	}
}
