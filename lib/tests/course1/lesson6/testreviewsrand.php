<?php
namespace Intervolga\Edu\Tests\Course1\Lesson6;

use Intervolga\Edu\Tests\BaseComponentTemplateTest;
use Intervolga\Edu\Util\Registry\Directory\Templates\ReviewsRandTemplate;
use Intervolga\Edu\Util\Registry\Iblock\ReviewsIblock;

class TestReviewsRand extends BaseComponentTemplateTest
{
	public static function run()
	{
		$iblock = ReviewsIblock::find();
		static::registerErrorIfRegistryDirectoryLost(ReviewsRandTemplate::class);
		if ($templateDir = ReviewsRandTemplate::find()) {
			static::checkTemplateDir($templateDir, $iblock);
		}
	}
}
