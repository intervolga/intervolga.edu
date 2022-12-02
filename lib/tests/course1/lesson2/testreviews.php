<?php
namespace Intervolga\Edu\Tests\Course1\Lesson2;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\FileSystem;
use Intervolga\Edu\Util\Menu;
use Intervolga\Edu\Util\Registry\Directory\ReviewsDirectory;

class TestReviews extends BaseTest
{
	public static function run()
	{
		static::checkDir();
		static::checkMenu();
	}

	protected static function checkDir()
	{
		Assert::registryDirectiry(ReviewsDirectory::class);
	}

	protected static function checkMenu()
	{
		$dirPath = ReviewsDirectory::find();
		if ($dirPath) {
			$links = Menu::getMenuLinks('/company/.left.menu.php');
			if (!array_key_exists(FileSystem::getLocalPath($dirPath), $links)) {
				static::registerError(Loc::getMessage('INTERVOLGA_EDU.REVIEWS_MENU_NEED', [
					'#VARIANT#' => FileSystem::getLocalPath($dirPath),
				]));
			}
		}
	}
}