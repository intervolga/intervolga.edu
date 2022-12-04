<?php
namespace Intervolga\Edu\Locator\IO;

use Bitrix\Main\Localization\Loc;

class ReviewsRandTemplate extends DirectoryLocator
{
	protected static function getPaths(): array
	{
		return [
			'/local/templates/.default/components/bitrix/news.list/reviews_rand/',
			'/local/templates/.default/components/bitrix/news.list/reviews.rand/',
			'/local/templates/.default/components/bitrix/news.list/rand_review/',
		];
	}

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.REVIEWS_RAND_TEMPLATE');
	}
}
