<?php
namespace Intervolga\Edu\Locator\Component\Template;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Locator\Component\ComponentLocator;
use Intervolga\Edu\Locator\Component\NewsList;

class Slider extends TemplateLocator
{
	public static function getFilter(): array
	{
		return [
			'=TEMPLATE_NAME' => INTERVOLGA_EDU_GUESS_VARIANTS['TEMPLATES']['SLIDER'],
		];
	}
	/**
	 * @return string|ComponentLocator
	 */
	public static function getComponent(): string
	{
		return NewsList::class;
	}


	public static function getFilter(): array
	{
		return ['?TEMPLATE_NAME' => 'slider || slider_promo || slider_list || slider_stock'];
	}

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.COMPONENT_SLIDER');
	}
}