<?php

namespace Intervolga\Edu\Locator\Iblock\Property;

use Bitrix\Main\Localization\Loc;
use CIBlockElement;
use CIBlockProperty;
use Intervolga\Edu\Locator\Iblock\IblockLocator;
use Intervolga\Edu\Locator\Iblock\PromoIblock;

class CatalogBindingProperty extends PropertyLocator
{
	/**
	 * @return string|IblockLocator
	 */
	public static function getIblock()
	{
		return PromoIblock::class;
	}

	public static function getFilter(): array
	{
		return [
			'=CODE' => [
				'LINK',
			],
			'PROPERTY_TYPE' => [
				'E'
			]
		];
	}

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.CATALOGBINDING_PROPERTY');
	}

	public static function getCountNotEmptyProperty()
	{
		$count = 0;
		if (!empty(CatalogBindingProperty::find())) {
			$arFilter = [
				"IBLOCK_ID" => PromoIblock::find()['ID'],
				'!=PROPERTY_LINK' => false
			];

			$count = CIblockElement::getList(false, $arFilter, [], false, false);
		}

		return $count;
	}

	public static function getPropertyParameters()
	{
		$result = CIBlockProperty::GetByID("LINK", PromoIblock::find()['ID']);

		return $result->fetch();
	}
}