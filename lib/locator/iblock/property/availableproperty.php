<?php
namespace Intervolga\Edu\Locator\Iblock\Property;

use Bitrix\Main\Localization\Loc;
use CIBlockElement;
use Intervolga\Edu\Locator\Iblock\IblockLocator;
use Intervolga\Edu\Locator\Iblock\ProductsIblock;
use Intervolga\Edu\Locator\Iblock\Section\SectionLocator;
use Intervolga\Edu\Locator\Iblock\Section\SoftFornitureSection;

class AvailableProperty extends PropertyLocator
{
	public static function getFilter(): array
	{
		return [
			'=CODE' => [
				'AVAILABLE',
				'AVAILABILITY',
			],
		];
	}

	public static function getCountNotEmptyProperty()
	{
		$count = 0;
		if (!empty(AvailableProperty::find())) {
			$arFilter = [
				"IBLOCK_ID" => static::getIblock()::find()['ID'],
				"SECTION_ID" => static::getSection()::find()['ID'],
				'!=PROPERTY_AVAILABILITY_VALUE' => false
			];

			$count = CIblockElement::getList(false, $arFilter, []);
		}

		return $count;
	}

	/**
	 * @return string|IblockLocator
	 */
	public static function getIblock()
	{
		return ProductsIblock::class;
	}

	/**
	 * @return string|SectionLocator
	 */
	public static function getSection()
	{
		return SoftFornitureSection::class;
	}

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.AVAILABLE_PROPERTY');
	}
}