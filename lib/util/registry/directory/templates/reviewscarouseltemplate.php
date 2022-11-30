<?php
namespace Intervolga\Edu\Util\Registry\Directory\Templates;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Util\Registry\Directory\BaseDirectory;

class ReviewsCarouselTemplate extends BaseDirectory
{
	public static function getPaths(): array
	{
		return [
			'/local/templates/.default/components/bitrix/news.list/carousel/',
			'/local/templates/.default/components/bitrix/news.list/reviews_carousel/',
			'/local/templates/.default/components/bitrix/news.list/reviews.carousel/',
		];
	}

	public static function getName(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.REVIEWS_CAROUSEL_TEMPLATE_DIRECTORY');
	}
}
