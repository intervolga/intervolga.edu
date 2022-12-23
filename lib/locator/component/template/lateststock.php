<?php
namespace Intervolga\Edu\Locator\Component\Template;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Locator\Component\ComponentLocator;
use Intervolga\Edu\Locator\Component\NewsList;

class LatestStock extends TemplateLocator
{
	public static function getFilter(): array
	{
		return [
			'=TEMPLATE_NAME' => INTERVOLGA_EDU_GUESS_VARIANTS['TEMPLATES']['LAST_PROMO'],
		];
	}

	/**
	 * @return string|ComponentLocator
	 */
	public static function getComponent(): string
	{
		return NewsList::class;
	}

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.LAST_PROMO_TEMPLATE');
	}
}