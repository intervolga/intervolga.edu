<?php
namespace Intervolga\Edu\Util\Registry\Directory;

use Bitrix\Main\Localization\Loc;

class ReviewsDirectory extends BaseDirectory
{

	public static function getPaths(): array
	{
		return [
			'/company/reviews/',
			'/company/review/',
		];
	}

	public static function getName(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.REVIEWS_DIRECTORY');
	}
}
