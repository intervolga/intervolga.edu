<?php

namespace Intervolga\Edu\Locator\Iblock\Section;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Locator\Iblock\ProductsIblock;

class SoftFornitureSection extends SectionLocator
{
	
	public static function getIblock()
	{
		return ProductsIblock::class;
	}
	
	public static function getFilter(): array
	{
		return [
			'=CODE' => [
				'myagkaya-mebel'
			],
		];
	}
	
	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.SOFT_FORNITURE_SECTION');
	}
}