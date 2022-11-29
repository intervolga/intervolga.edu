<?php
namespace Intervolga\Edu\Tests\Course1\Lesson2;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\FileSystem;
use Intervolga\Edu\Util\Menu;

class TestServicesDeleted extends BaseTest
{
	public static function run()
	{
		static::checkDir();
		static::checkMenu();
	}

	protected static function checkDir()
	{
		$directory = FileSystem::getDirectory('/services/');
		static::registerErrorIfFileSystemEntryExists($directory, Loc::getMessage('INTERVOLGA_EDU.SERVICES_DELETE_REASON'));
	}

	protected static function checkMenu()
	{
		$links = Menu::getMenuLinks('/.top.menu.php');
		if ($links['services/']) {
			static::registerError(Loc::getMessage('INTERVOLGA_EDU.SERVICES_MENU_DELETE'));
		}
	}
}