<?php
namespace Intervolga\Edu\Tests\Course1\Lesson6;

use Intervolga\Edu\Tests\BaseComponentTemplateTest;
use Intervolga\Edu\Util\Registry\Directory\Templates\ReviewsCarouselTemplate;
use Intervolga\Edu\Util\Registry\Iblock\ReviewsIblock;

class TestReviewsCarousel extends BaseComponentTemplateTest
{
	public static function run()
	{
		$iblock = ReviewsIblock::find();
		static::registerErrorIfRegistryDirectoryLost(ReviewsCarouselTemplate::class);
		if ($templateDir = ReviewsCarouselTemplate::find()) {
			static::checkTemplateDir($templateDir, $iblock);
		}
	}
}
