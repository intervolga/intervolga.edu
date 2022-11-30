<?php
namespace Intervolga\Edu\Tests\Course1\Lesson2;

use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\Registry\Directory\PromoDirectory;

class TestPromo extends BaseTest
{
	public static function run()
	{
		static::registerErrorIfRegistryDirectoryLost(PromoDirectory::class);
	}
}