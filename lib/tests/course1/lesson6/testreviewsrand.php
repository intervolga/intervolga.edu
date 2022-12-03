<?php
namespace Intervolga\Edu\Tests\Course1\Lesson6;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseComponentTemplateTest;
use Intervolga\Edu\Util\Registry\Directory\Templates\ReviewsRandTemplate;
use Intervolga\Edu\Util\Registry\Iblock\ReviewsIblock;

class TestReviewsRand extends BaseComponentTemplateTest
{
	protected static function run()
	{
		$iblock = ReviewsIblock::find();
		Assert::registryDirectiry(ReviewsRandTemplate::class);
		if ($templateDir = ReviewsRandTemplate::find()) {
			static::checkTemplateDir($templateDir, $iblock);
		}
	}
}
