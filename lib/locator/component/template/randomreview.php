<?php

namespace Intervolga\Edu\Locator\Component\Template;

use Intervolga\Edu\Locator\Component\NewsList;

class RandomReview extends TemplateLocator
{

	public static function getFilter(): array
	{
		return ['?TEMPLATE_NAME' => 'rand_reviews || rand_review || random_review || random_reviews'];
	}

	public static function getComponent(): string
	{
		return NewsList::class;
	}
}