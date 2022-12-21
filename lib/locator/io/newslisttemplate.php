<?php

namespace Intervolga\Edu\Locator\IO;

use Bitrix\Main\Localization\Loc;

class NewsListTemplate extends DirectoryLocator
{

	protected static function getPaths(): array
	{
		return [
			'/local/templates/.default/components/bitrix/news/news_dir/bitrix/news.detail/.default',
			'/local/templates/.default/components/bitrix/news/news_for_news/bitrix/news.detail/.default',
		];
	}

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.NEWS_TEMPLATE');
	}
}