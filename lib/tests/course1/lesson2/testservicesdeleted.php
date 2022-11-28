<?php
namespace Intervolga\Edu\Tests\Course1\Lesson2;

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Util\BaseTest;
use Intervolga\Edu\Util\FileSystem;

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
		Loader::includeModule('fileman');
		$file = FileSystem::getFile('/.top.menu.php');
		if ($file->isExists()) {
			$menu = \CFileMan::getMenuArray($file->getPath());
			foreach ($menu['aMenuLinks'] as $menuLink) {
				if ($menuLink[1] == 'services/') {
					static::registerError(Loc::getMessage('INTERVOLGA_EDU.SERVICES_MENU_DELETE'));
				}
			}
		}
	}
}