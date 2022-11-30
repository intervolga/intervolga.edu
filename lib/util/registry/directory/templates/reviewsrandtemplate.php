<?php
namespace Intervolga\Edu\Util\Registry\Directory\Templates;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Util\Registry\Directory\BaseDirectory;

class ReviewsRandTemplate extends BaseDirectory
{
	public static function getPaths(): array
	{
		return [
			'/local/templates/.default/components/bitrix/news.list/reviews_rand/',
			'/local/templates/.default/components/bitrix/news.list/reviews.rand/',
			'/local/templates/.default/components/bitrix/news.list/rand_review/',
		];
	}

	public static function getName(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.REVIEWS_RAND_TEMPLATE');
	}
}
