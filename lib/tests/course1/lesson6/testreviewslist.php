<?php
namespace Intervolga\Edu\Tests\Course1\Lesson6;

use Intervolga\Edu\Assert;
use Intervolga\Edu\Tests\BaseComponentTemplateTest;
use Intervolga\Edu\Util\Registry\Directory\Templates\ReviewsListTemplate;
use Intervolga\Edu\Util\Registry\Iblock\ReviewsIblock;

class TestReviewsList extends BaseComponentTemplateTest
{
	public static function run()
	{
		$iblock = ReviewsIblock::find();
		Assert::registryDirectiry(ReviewsListTemplate::class);
		if ($templateDir = ReviewsListTemplate::find()) {
			static::checkTemplateDir($templateDir, $iblock);
		}
	}
}
