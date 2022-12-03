<?php
namespace Intervolga\Edu\Locator\IO;

use Bitrix\Main\Localization\Loc;

class ReviewsCarouselTemplate extends DirectoryLocator
{
	public static function getPaths(): array
	{
		return [
			'/local/templates/.default/components/bitrix/news.list/carousel/',
			'/local/templates/.default/components/bitrix/news.list/reviews_carousel/',
			'/local/templates/.default/components/bitrix/news.list/reviews.carousel/',
		];
	}

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.REVIEWS_CAROUSEL_TEMPLATE_DIRECTORY');
	}
}
