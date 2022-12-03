<?php
namespace Intervolga\Edu\Locator\IO;

use Bitrix\Main\Localization\Loc;

class ReviewsListTemplate extends DirectoryLocator
{
	public static function getPaths(): array
	{
		return [
			'/local/templates/.default/components/bitrix/news.list/reviews_list/',
			'/local/templates/.default/components/bitrix/news.list/reviews.list/',
			'/local/templates/.default/components/bitrix/news.list/list_review/',
			'/local/templates/.default/components/bitrix/news.list/list_reviews/',
		];
	}

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.REVIEWS_LIST_TEMPLATE');
	}
}
