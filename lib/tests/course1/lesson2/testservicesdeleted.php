<?php
namespace Intervolga\Edu\Tests\Course1\Lesson2;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Util\BaseTest;
use Intervolga\Edu\Util\FileSystem;

class TestServicesDeleted extends BaseTest
{
	public static function run()
	{
		$directory = FileSystem::getDirectory('/services/');
		static::registerErrorIfFileSystemEntryExists($directory, Loc::getMessage('INTERVOLGA_EDU.SERVICES_DELETE_REASON'));
	}
}