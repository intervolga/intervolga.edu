<?php
namespace Intervolga\Edu\Tests\Course1New\Lesson4;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\FileSystem;
/*
 *  Пока неактивный тест, непонятно есть ли в нем смысл
 */
class TestAfterConnect extends BaseTest
{
	protected static function run()
	{
		$afterconnFile = FileSystem::getFile("/bitrix/php_interface/after_connect_d7.php  .php");
		Assert::fseExists($afterconnFile);
	}
}