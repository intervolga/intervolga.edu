<?php
namespace Intervolga\Edu\Tests\Course1\Lesson2;

use Bitrix\Main\Application;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\FileSystem;

class TestLocalPhpInterface extends BaseTest
{
	public static function interceptErrors()
	{
		return true;
	}

	protected static function run()
	{
		Assert::directoryExists(FileSystem::getDirectory('/local/'));
		Assert::directoryExists(FileSystem::getDirectory('/local/php_interface/'));
		Assert::fseExists(FileSystem::getFile('/local/php_interface/init.php'));

		Assert::phpSniffer([Application::getDocumentRoot() . '/local/php_interface/init.php'], ['wasteInitChecker']);
	}
}