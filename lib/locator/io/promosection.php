<?php
namespace Intervolga\Edu\Locator\IO;

use Bitrix\Main\Localization\Loc;

class PromoSection extends DirectoryLocator
{
	protected static function getPaths(): array
	{
		return [
			'/promo/',
			'/discounts/',
			'/discount/',
			'/stocks/',
			'/stock/',
			'/promotions/'
		];
	}

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.PROMO_DIRECTORY');
	}
}
