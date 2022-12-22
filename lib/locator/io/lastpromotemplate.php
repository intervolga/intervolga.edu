<?php
namespace Intervolga\Edu\Locator\IO;

use Bitrix\Main\Localization\Loc;

class LastPromoTemplate extends DirectoryLocator
{
	protected static function getPaths(): array
	{
		return [
			'/local/templates/.default/components/bitrix/news.list/last_promo/',
			'/local/templates/.default/components/bitrix/news.list/last.promo/',
			'/local/templates/.default/components/bitrix/news.list/stocks_list/',
		];
	}

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.LAST_PROMO_TEMPLATE');
	}
}
