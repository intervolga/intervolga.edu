<?php
namespace Intervolga\Edu\Tests\Course1\Lesson2;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\Menu;
use Intervolga\Edu\Util\PathsRegistry;

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
		static::registerErrorIfAllFileSystemEntriesLost(
			PathsRegistry::getReviewsPossibleDirectories(),
			Loc::getMessage('INTERVOLGA_EDU.REVIEWS_SECTION_NEED')
		);
	}

	protected static function checkMenu()
	{
		$links = Menu::getMenuLinks('/company/.left.menu.php');
		if (!array_intersect(static::getPossiblePaths(), array_keys($links))) {
			static::registerError(Loc::getMessage('INTERVOLGA_EDU.REVIEWS_MENU_NEED'));
		}
	}
}