<?php
namespace Intervolga\Edu\Tests\Course1New\Lesson4;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\FileSystem;

class TestDBQueryError extends BaseTest
{
	protected static function run()
	{
		Assert::fseExists(FileSystem::getFile("/bitrix/php_interface/dbquery_error.php"));
	}
}