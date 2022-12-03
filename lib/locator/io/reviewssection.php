<?php
namespace Intervolga\Edu\Locator\IO;

use Bitrix\Main\Localization\Loc;

class ReviewsSection extends DirectoryLocator
{
	public static function getPaths(): array
	{
		return [
			'/company/reviews/',
			'/company/review/',
		];
	}

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.REVIEWS_DIRECTORY');
	}
}
