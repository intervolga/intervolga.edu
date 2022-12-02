<?php
namespace Intervolga\Edu\Tests\Course1\Lesson2;

use Intervolga\Edu\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\FileSystem;

class TestServicesDeleted extends BaseTest
{
	protected static function run()
	{
		Assert::directoryNotExists(FileSystem::getDirectory('/services/'));
		Assert::menuItemNotExists('/.top.menu.php', 'services/');
	}
}