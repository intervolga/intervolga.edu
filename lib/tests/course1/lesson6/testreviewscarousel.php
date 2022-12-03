<?php
namespace Intervolga\Edu\Tests\Course1\Lesson6;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\Iblock\ReviewsIblock;
use Intervolga\Edu\Locator\IO\ReviewsCarouselTemplate;
use Intervolga\Edu\Tests\BaseComponentTemplateTest;

class TestReviewsCarousel extends BaseComponentTemplateTest
{
	protected static function run()
	{
		$iblock = ReviewsIblock::find();
		Assert::directoryLocator(ReviewsCarouselTemplate::class);
		if ($templateDir = ReviewsCarouselTemplate::find()) {
			static::checkTemplateDir($templateDir, $iblock);
		}
	}
}
