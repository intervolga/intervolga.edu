<?php
namespace Intervolga\Edu\Locator\Iblock\Property;

use Bitrix\Main\Localization\Loc;
use CIBlockElement;
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
		if (!empty(AvailableProperty::find())) {
			$arFilter = [
				"IBLOCK_ID" => 2,
				"SECTION_ID" => 1,
				'!=PROPERTY_AVAILABILITY_VALUE' => false
			];

			$count = CIblockElement::getList(false, $arFilter, [], false, false);
		}

		return $count;
	}

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.AVAILABLE_PROPERTY');
	}
}