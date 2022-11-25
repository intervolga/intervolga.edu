<?php
namespace Intervolga\Edu\Tests\Course1\Lesson2;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Util\BaseTest;
use Intervolga\Edu\Util\FilesetBuilder;
use Intervolga\Edu\Util\FileSystem;

class TestPartners extends BaseTest
{
	public static function run()
	{
		$paths = [
			FileSystem::getDirectory('/for-partners/'),
			FileSystem::getDirectory('/partners/'),
			FileSystem::getDirectory('/partner/'),
		];
		static::registerErrorIfAllFileSystemEntriesLost($paths, Loc::getMessage('INTERVOLGA_EDU.PARTNERS_DIR_NOT_FOUND'));
	}
}