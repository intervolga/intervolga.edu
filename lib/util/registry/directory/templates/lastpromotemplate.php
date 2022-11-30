<?php
namespace Intervolga\Edu\Util\Registry\Directory\Templates;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Util\Registry\Directory\BaseDirectory;

class LastPromoTemplate extends BaseDirectory
{
	public static function getPaths(): array
	{
		return [
			'/local/templates/.default/components/bitrix/news.list/last_promo/',
			'/local/templates/.default/components/bitrix/news.list/last.promo/',
		];
	}

	public static function getName(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.LAST_PROMO_TEMPLATE');
	}
}
