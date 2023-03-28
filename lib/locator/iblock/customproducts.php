<?php
namespace Intervolga\Edu\Locator\Iblock;

use Bitrix\Main\Localization\Loc;

class CustomProducts extends IblockLocator
{
	public static function getFilter(): array
	{
		return [
			'=CODE' => [
				'products',
				'product',
			],
		];
	}

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.CUSTOM_IBLOCK_PRODUCTS');
	}
}