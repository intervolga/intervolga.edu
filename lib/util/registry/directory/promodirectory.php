<?php
namespace Intervolga\Edu\Util\Registry\Directory;

use Bitrix\Main\Localization\Loc;

class PromoDirectory extends BaseDirectory
{
	public static function getPaths(): array
	{
		return [
			'/promo/',
			'/discounts/',
			'/discount/',
			'/stocks/',
			'/stock/',
		];
	}

	public static function getName(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.PROMO_DIRECTORY');
	}
}
