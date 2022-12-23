<?php

namespace Intervolga\Edu\Locator\Component\Template;

use Intervolga\Edu\Locator\Component\ComponentLocator;
use Intervolga\Edu\Locator\Component\NewsList;

class LatestStock extends TemplateLocator
{

	public static function getFilter(): array
	{
		return ['?TEMPLATE_NAME' => 'latest_promo || latest_stock || stock_panel || promo_panel'];
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
		return 'latest_promo || latest_stock || stock_panel || promo_panel';
	}
}