<?php

namespace Intervolga\Edu\Locator\Iblock\Property;

use Bitrix\Iblock\ElementPropertyTable;
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
	
	public static function getCountNotEmtyProperty()
	{
		$count = 0;
		if (AvailableProperty::find())
		{
			$count = ElementPropertyTable::GetCount(
				[
					'IBLOCK_PROPERTY_ID' => AvailableProperty::find()['ID'],
				
				],
			);
		}
		
		return $count;
	}
	
	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.AVAILABLE_PROPERTY');
	}
}