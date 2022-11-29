<?php
namespace Intervolga\Edu\Util\Registry\Iblock;

use Bitrix\Main\Localization\Loc;

class PromoIblock extends BaseIblock
{
	public static function getFilter(): array
	{
		return [
			'=CODE' => [
				'promo',
				'promos',
				'stock',
			],
		];
	}

	public static function getName(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.IBLOCK_PROMO');
	}
}