<?php
namespace Intervolga\Edu\Locator\IO\ComponentTemplate;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Locator\IO\DirectoryLocator;

class ReviewsCarouselTemplate extends DirectoryLocator
{
	protected static function getPaths(): array
	{
		$result = [];
		$basePath = '/local/templates/.default/components/bitrix/news.list/';
		foreach (INTERVOLGA_EDU_GUESS_VARIANTS['TEMPLATES']['REVIEWS_CAROUSEL'] as $template) {
			$result[] = $basePath . $template . '/';
		}

		return $result;
	}

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.REVIEWS_CAROUSEL_TEMPLATE_DIRECTORY');
	}
}
