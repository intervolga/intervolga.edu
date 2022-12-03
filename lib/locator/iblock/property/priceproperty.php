<?php
namespace Intervolga\Edu\Locator\Iblock\Property;

use Bitrix\Main\Localization\Loc;
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
		];
	}

	public static function getName(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.PRICE_PROPERTY');
	}
}
