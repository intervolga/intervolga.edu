<?php
namespace Intervolga\Edu\Locator\IO;

use Bitrix\Main\Localization\Loc;

class PromoNewsTemplate extends DirectoryLocator
{
	protected static function getPaths(): array
	{
		return [
			'/local/templates/.default/components/bitrix/news/news_stocks/',
			'/local/templates/.default/components/bitrix/news/promo/',
			'/local/templates/.default/components/bitrix/news/promos/',
		];
	}

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.PROMO_NEWS_TEMPLATE_DIRECTORY');
	}
}
