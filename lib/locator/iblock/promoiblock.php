<?php
namespace Intervolga\Edu\Locator\Iblock;

use Bitrix\Main\Localization\Loc;

class PromoIblock extends IblockLocator
{
	public static function getFilter(): array
	{
		return [
			'=CODE' => [
				'promo',
				'promos',
				'stock',
				'stocks',
                'promotion',
			],
		];
	}

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.IBLOCK_PROMO');
	}
}