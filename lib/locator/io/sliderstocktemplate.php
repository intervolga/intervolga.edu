<?php

namespace Intervolga\Edu\Locator\IO;

use Bitrix\Main\Localization\Loc;

class SliderStockTemplate extends DirectoryLocator
{

	protected static function getPaths(): array
	{
		return [
			'/local/templates/.default/components/bitrix/news.list/slider/',
			'/local/templates/.default/components/bitrix/news.list/slider_promo/',
			'/local/templates/.default/components/bitrix/news.list/slider_stock/',
		];
	}

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.SLIDER_STOCK_TEMPLATE');
	}
}