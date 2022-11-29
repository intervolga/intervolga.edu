<?php
namespace Intervolga\Edu\Tests\Course1\Lesson2;

use Bitrix\Main\IO\Directory;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\FileSystem;

class TestPartners extends BaseTest
{
	/**
	 * @return array|Directory[]
	 */
	public static function getPossibleDirectories()
	{
		return [
			FileSystem::getDirectory('/for-partners/'),
			FileSystem::getDirectory('/partners/'),
			FileSystem::getDirectory('/partner/'),
		];
	}
	public static function run()
	{
		$paths = static::getPossibleDirectories();
		static::registerErrorIfAllFileSystemEntriesLost($paths, Loc::getMessage('INTERVOLGA_EDU.PARTNERS_DIR_NOT_FOUND'));
	}
}