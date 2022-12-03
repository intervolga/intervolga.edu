<?php
namespace Intervolga\Edu\Locator\IO;

use Bitrix\Main\Localization\Loc;

class PromoSection extends DirectoryLocator
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

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.PROMO_DIRECTORY');
	}
}
