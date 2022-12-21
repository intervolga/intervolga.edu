<?php
namespace Intervolga\Edu\Locator\Component\Template;

use Intervolga\Edu\Locator\Component\ComponentLocator;
use Intervolga\Edu\Locator\Component\NewsList;

class RandomReview extends TemplateLocator
{

	public static function getFilter(): array
	{
		return ['?TEMPLATE_NAME' => 'rand_reviews || rand_review || random_review || random_reviews'];
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
		return 'rand_reviews || rand_review || random_review || random_reviews';
	}
}