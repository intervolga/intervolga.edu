<?php
namespace Intervolga\Edu\Util\Registry\Iblock;

use Bitrix\Main\Localization\Loc;

class NewsIblock extends BaseIblock
{
	public static function getFilter(): array
	{
		return [
			'=CODE' => [
				'furniture_news_s1',
			],
		];
	}

	public static function getName(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.IBLOCK_NEWS');
	}
}