<?php

namespace Intervolga\Edu\Locator\Component\Template;

use Intervolga\Edu\Locator\Component\ComponentLocator;
use Intervolga\Edu\Locator\Component\NewsList;

class ReviewCarousel extends TemplateLocator
{

	public static function getFilter(): array
	{
		return ['?TEMPLATE_NAME' => 'reviewCarousel || review_carousel || reviews_carousel || carousel'];
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
		return 'reviewCarousel || review_carousel || reviews_carousel || carousel';
	}
}