<?php
namespace Intervolga\Edu\Tests\Course1\Lesson2;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\FileSystem;

class TestServicesDeleted extends BaseTest
{
	public static function interceptErrors()
	{
		return true;
	}

	protected static function run()
	{
		Assert::directoryNotExists(FileSystem::getDirectory('/services/'));
		Assert::menuItemNotExists('/.top.menu.php', 'services/');
	}
}