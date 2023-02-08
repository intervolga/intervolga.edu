<?php
namespace Intervolga\Edu\Tests\Course1\Lesson41;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;

class TestBottomMenuItems extends BaseTest
{
	public static function interceptErrors()
	{
		return true;
	}

	protected static function run()
	{
		$fields = [
			'/company/reviews/',
			'/contacts/',
			'/company/management/',
			'/company/history/'
		];

		foreach ($fields as $field) {
			Assert::menuItemExists('/.bottom.menu.php', $field);
		}

		Assert::menuItemsCount('/.bottom.menu.php', count($fields));
	}
}
