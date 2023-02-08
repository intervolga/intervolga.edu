<?php
namespace Intervolga\Edu\Tests\Course1\Lesson41;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\FileSystem;

class TestAboutMenuItems extends BaseTest
{
	public static function interceptErrors()
	{
		return true;
	}

	protected static function run()
	{
		$menuFile = FileSystem::getFile('/.about.menu.php');
		if ($menuFile->isExists()) {
			Assert::fseExists($menuFile);
			$fields = [
				'/company/reviews/',
				'/contacts/',
				'/company/management/',
				'/company/history/'
			];

			foreach ($fields as $field) {
				Assert::menuItemExists('/.about.menu.php', $field);
			}

			Assert::menuItemsCount('/.about.menu.php', count($fields));
		}
	}
}
