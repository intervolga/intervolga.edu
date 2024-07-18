<?php
namespace Intervolga\Edu\Locator\Iblock\Section;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Locator\Iblock\ProductsIblock;

class OfficeFurniture extends SectionLocator
{

	public static function getIblock()
	{
		return ProductsIblock::class;
	}

	public static function getFilter(): array
	{
		return [
			'=CODE' => [
				'office',
				'office_furniture',
				'office-furniture',
				'office_furnishings',
			],
		];
	}

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.OFFICE_FORNITURE_SECTION');
	}
}