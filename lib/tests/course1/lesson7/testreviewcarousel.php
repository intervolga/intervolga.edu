<?php
namespace Intervolga\Edu\Tests\Course1\Lesson7;

use Intervolga\Edu\Locator\Component\Template\ReviewCarousel;
use Intervolga\Edu\Locator\Component\Template\TemplateLocator;
use Intervolga\Edu\Tests\BaseTestTemplateParameters;

class TestReviewCarousel extends BaseTestTemplateParameters
{

	/**
	 * @return string|TemplateLocator
	 */
	protected static function getLocator()
	{
		return ReviewCarousel::class;
	}
}