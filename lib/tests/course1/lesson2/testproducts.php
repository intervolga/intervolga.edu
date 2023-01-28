<?php
namespace Intervolga\Edu\Tests\Course1\Lesson2;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\Menu;

class TestProducts extends BaseTest
{
	protected static function run()
	{
		$links = Menu::getMenuLinks('/.top.menu.php', true);
		Assert::eq(
			$links['products'],
			Loc::getMessage('INTERVOLGA_EDU.PRODUCTS_CORRECT_NAME')
		);
	}
}
