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
	public static function getPropertyBind(){
		global $DB;
		$rows = $DB->Query('SELECT * FROM b_iblock_element_property WHERE IBLOCK_PROPERTY_ID = '.AvailableProperty::find()['ID']);
		while ($row = $rows->GetNext())
		{
			$elements[] = $row;
		}
		return $elements;
	}
	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.AVAILABLE_PROPERTY');
	}
}

{
	
}