<?php
namespace Intervolga\Edu\Tests\Course1\Lesson6;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\Iblock\ReviewsIblock;
use Intervolga\Edu\Locator\IO\ReviewsListTemplate;
use Intervolga\Edu\Tests\BaseComponentTemplateTest;

class TestReviewsList extends BaseComponentTemplateTest
{
	protected static function run()
	{
		$iblock = ReviewsIblock::find();
		Assert::directoryLocator(ReviewsListTemplate::class);
		if ($templateDir = ReviewsListTemplate::find()) {
			static::checkTemplateDir($templateDir, $iblock);
		}
	}
}
