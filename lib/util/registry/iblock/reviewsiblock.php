<?php
namespace Intervolga\Edu\Util\Registry\Iblock;

use Bitrix\Main\Localization\Loc;

class ReviewsIblock extends BaseIblock
{
	public static function getFilter(): array
	{
		return [
			'=CODE' => [
				'reviews',
			],
		];
	}

	public static function getName(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.IBLOCK_REVIEWS');
	}
}