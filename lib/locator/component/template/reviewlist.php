<?php

namespace Intervolga\Edu\Locator\Component\Template;

use Intervolga\Edu\Locator\Component\ComponentLocator;
use Intervolga\Edu\Locator\Component\NewsList;
use Intervolga\Edu\Locator\IO\ReviewsListTemplate;

class ReviewList extends TemplateLocator
{

	public static function getFilter(): array
	{
		return ['?TEMPLATE_NAME' => 'review_list || reviews_list || list_review || list_reviews'];
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
		return 'review_list || reviews_list || list_review || list_reviews';
	}
}