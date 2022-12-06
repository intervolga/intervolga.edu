<?php

namespace Intervolga\Edu\Locator\Iblock\Property;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Locator\Iblock\ProductsIblock;

class AvailableProperty extends PropertyLocator
{
	public static function getIblock()
	{
		return ProductsIblock::class;
	}
	
	public static function getFilter(): array
	{
		return [
			'=CODE' => [
				'AVAILABLE',
				'AVAILABILITY',
			],
		];
	}
	
	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.AVAILABLE_PROPERTY');
	}
}

{
	
}