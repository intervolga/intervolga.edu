<?php
namespace Intervolga\Edu\Tests\Course1\Lesson2;

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Util\BaseTest;
use Intervolga\Edu\Util\FileSystem;

class TestReviews extends BaseTest
{
	public static function run()
	{
		static::checkDir();
		static::checkMenu();
	}

	protected static function getPossiblePaths()
	{
		return [
			'/company/reviews/',
			'/company/review/',
		];
	}

	protected static function checkDir()
	{
		$paths = [];
		foreach (static::getPossiblePaths() as $path) {
			$paths[] = FileSystem::getDirectory($path);
		}
		static::registerErrorIfAllFileSystemEntriesLost($paths, Loc::getMessage('INTERVOLGA_EDU.REVIEWS_SECTION_NEED'));
	}

	protected static function checkMenu()
	{
		Loader::includeModule('fileman');
		$file = FileSystem::getFile('/company/.left.menu.php');
		if ($file->isExists()) {
			$menu = \CFileMan::getMenuArray($file->getPath());
			$found = false;
			foreach ($menu['aMenuLinks'] as $menuLink) {
				if (in_array($menuLink[1], static::getPossiblePaths())) {
					$found = true;
				}
			}
			if (!$found)
			{
				static::registerError(Loc::getMessage('INTERVOLGA_EDU.REVIEWS_MENU_NEED'));
			}
		}
	}
}