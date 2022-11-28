<?php
namespace Intervolga\Edu\Tests\Course1\Lesson2;

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Util\BaseTest;
use Intervolga\Edu\Util\FileSystem;

class TestProducts extends BaseTest
{
	public static function run()
	{
		Loader::includeModule('fileman');
		$file = FileSystem::getFile('/.top.menu.php');
		if ($file->isExists()) {
			$menu = \CFileMan::getMenuArray($file->getPath());
			foreach ($menu['aMenuLinks'] as $menuLink) {
				if ($menuLink[1] == 'products/') {
					if ($menuLink[0] != Loc::getMessage('INTERVOLGA_EDU.PRODUCTS_CORRECT_NAME')) {
						static::registerError(Loc::getMessage('INTERVOLGA_EDU.PRODUCTS_MENU_INCORRECT_NAME'));
					}
				}
			}
		}
	}
}
