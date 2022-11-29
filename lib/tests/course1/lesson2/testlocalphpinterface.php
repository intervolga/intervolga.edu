<?php
namespace Intervolga\Edu\Tests\Course1\Lesson2;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\FileSystem;

class TestLocalPhpInterface extends BaseTest
{
	public static function run()
	{
		$path = FileSystem::getFile('/local/php_interface/init.php');
		static::registerErrorIfFileSystemEntryLost($path, Loc::getMessage('INTERVOLGA_EDU.LOCAL_PHP_INTERFACE_NOT_FOUND'));
	}
}