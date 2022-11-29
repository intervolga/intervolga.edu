<?php
namespace Intervolga\Edu\Tests\Course1\Lesson2;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Util\BaseTest;
use Intervolga\Edu\Util\Menu;

class TestProducts extends BaseTest
{
	public static function run()
	{
		$links = Menu::getMenuLinks('/.top.menu.php');
		if ($links['products/']) {
			if ($links['products/'] != Loc::getMessage('INTERVOLGA_EDU.PRODUCTS_CORRECT_NAME')) {
				static::registerError(Loc::getMessage('INTERVOLGA_EDU.PRODUCTS_MENU_INCORRECT_NAME'));
			}
		}
	}
}
