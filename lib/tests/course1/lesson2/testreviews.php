<?php
namespace Intervolga\Edu\Tests\Course1\Lesson2;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\IO\ReviewsSection;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\FileSystem;

class TestReviews extends BaseTest
{
	protected static function run()
	{
		Assert::directoryLocator(ReviewsSection::class);
		Assert::menuItemExists('/company/.left.menu.php', FileSystem::getLocalPath(ReviewsSection::find()));
	}
}