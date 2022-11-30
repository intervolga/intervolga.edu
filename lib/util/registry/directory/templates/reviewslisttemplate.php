<?php
namespace Intervolga\Edu\Util\Registry\Directory\Templates;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Util\Registry\Directory\BaseDirectory;

class ReviewsListTemplate extends BaseDirectory
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

	public static function getName(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.REVIEWS_LIST_TEMPLATE');
	}
}
