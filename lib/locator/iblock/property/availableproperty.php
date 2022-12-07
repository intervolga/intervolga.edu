<?php

namespace Intervolga\Edu\Locator\Iblock\Property;

use Bitrix\Iblock\ElementTable;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Locator\Iblock\ProductsIblock;
use Intervolga\Edu\Locator\Iblock\Section\SoftFornitureSection;

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
	public static function getCountNotEmtyProperty(){
		$count = ElementTable::GetList(
			[
				'filter' =>
					[
						"IBLOCK_ID"=> ProductsIblock::find()['ID'],
						"IBLOCK_SECTION_ID" => SoftFornitureSection::find()['ID'],
						'=CODE' =>
							[
							'AVAILABLE',
							'AVAILABILITY',
							],
					],
				'select' => ['CNT'],
			]
		);
		
		return $count;
	}
	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.AVAILABLE_PROPERTY');
	}
}