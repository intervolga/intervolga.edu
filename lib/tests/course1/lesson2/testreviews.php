<?php
namespace Intervolga\Edu\Tests\Course1\Lesson2;

use Intervolga\Edu\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\FileSystem;
use Intervolga\Edu\Util\Registry\Directory\ReviewsDirectory;

class TestReviews extends BaseTest
{
	protected static function run()
	{
		Assert::registryDirectiry(ReviewsDirectory::class);
		Assert::menuItemExists('/company/.left.menu.php', FileSystem::getLocalPath(ReviewsDirectory::find()));
	}
}