<?php
namespace Intervolga\Edu\Tests\Course1\Lesson6;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\Iblock\ReviewsIblock;
use Intervolga\Edu\Locator\IO\ReviewsRandTemplate;
use Intervolga\Edu\Tests\BaseComponentTemplateTest;

class TestReviewsRand extends BaseComponentTemplateTest
{
	protected static function run()
	{
		$iblock = ReviewsIblock::find();
		Assert::directoryLocator(ReviewsRandTemplate::class);
		if ($templateDir = ReviewsRandTemplate::find()) {
			static::checkTemplateDir($templateDir, $iblock);
		}
	}
}
