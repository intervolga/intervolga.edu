<?php
namespace Intervolga\Edu\Tests\Course1\Lesson2;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Util\BaseTest;
use Intervolga\Edu\Util\FileSystem;
use Intervolga\Edu\Util\Menu;

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
		$links = Menu::getMenuLinks('/company/.left.menu.php');
		if (!array_intersect(static::getPossiblePaths(), array_keys($links))) {
			static::registerError(Loc::getMessage('INTERVOLGA_EDU.REVIEWS_MENU_NEED'));
		}
	}
}