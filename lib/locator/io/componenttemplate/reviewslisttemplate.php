<?php
namespace Intervolga\Edu\Locator\IO\ComponentTemplate;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Locator\IO\DirectoryLocator;

class ReviewsListTemplate extends DirectoryLocator
{
	protected static function getPaths(): array
	{
		$result = [];
		$basePath = '/local/templates/.default/components/bitrix/news.list/';
		foreach (INTERVOLGA_EDU_GUESS_VARIANTS['TEMPLATES']['REVIEWS_LIST'] as $template) {
			$result[] = $basePath . $template . '/';
		}

		return $result;
	}

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.REVIEWS_LIST_TEMPLATE_DIRECTORY');
	}
}
