<?php
namespace Intervolga\Edu\Util\Registry\Iblock\Property;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Util\Registry\Iblock\ReviewsIblock;

class PostProperty extends BaseProperty
{
	public static function getIblock()
	{
		return ReviewsIblock::class;
	}

	public static function getFilter(): array
	{
		return [
			'=CODE' => [
				'POST',
				'POSITION',
				'WORK',
			],
		];
	}

	public static function getName(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.POST_PROPERTY');
	}
}
