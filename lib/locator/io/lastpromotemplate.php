<?php
namespace Intervolga\Edu\Locator\IO;

use Bitrix\Main\Localization\Loc;

class LastPromoTemplate extends DirectoryLocator
{
	protected static function getPaths(): array
	{
		$result = [];
		$basePath = '/local/templates/.default/components/bitrix/news.list/';
		foreach (INTERVOLGA_EDU_GUESS_VARIANTS['TEMPLATES']['LAST_PROMO'] as $template) {
			$result[] = $basePath . $template . '/';
		}
		return $result;
	}

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.LAST_PROMO_TEMPLATE_DIRECTORY');
	}
}
