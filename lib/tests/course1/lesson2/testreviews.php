<?php
namespace Intervolga\Edu\Tests\Course1\Lesson2;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Util\BaseTest;
use Intervolga\Edu\Util\FileSystem;

class TestReviews extends BaseTest
{
	public static function run()
	{
		$paths = [
			FileSystem::getDirectory('/company/reviews/'),
			FileSystem::getDirectory('/company/review/'),
		];
		static::registerErrorIfAllFileSystemEntriesLost($paths, Loc::getMessage('INTERVOLGA_EDU.REVIEWS_SECTION_NEED'));
	}
}