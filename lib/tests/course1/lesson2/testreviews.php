<?php
namespace Intervolga\Edu\Tests\Course1\Lesson2;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\FileSystem;
use Intervolga\Edu\Util\Menu;
use Intervolga\Edu\Util\Registry\PathsRegistry;

class TestReviews extends BaseTest
{
	public static function run()
	{
		static::checkDir();
		static::checkMenu();
	}

	protected static function checkDir()
	{
		static::registerErrorIfAllFileSystemEntriesLost(
			PathsRegistry::getReviewsPossibleDirectories(),
			Loc::getMessage('INTERVOLGA_EDU.REVIEWS_SECTION_NEED')
		);
	}

	protected static function checkMenu()
	{
		$dirs = PathsRegistry::getReviewsPossibleDirectories();
		$links = Menu::getMenuLinks('/company/.left.menu.php');

		$found = false;
		foreach ($dirs as $dir) {
			$dirPath = FileSystem::getLocalPath($dir);
			if (in_array($dirPath, array_keys($links))) {
				$found = true;
			}
		}

		if (!$found) {
			static::registerError(Loc::getMessage('INTERVOLGA_EDU.REVIEWS_MENU_NEED', [
				'#VARIANT#' => FileSystem::getLocalPath($dirs[0]),
			]));
		}
	}
}