<?php
namespace Intervolga\Edu\Tests\Course1\Lesson2;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Tests\BaseTest;

class TestDumpFunction extends BaseTest
{
	public static function run()
	{
		if (!function_exists('test_dump')) {
			static::registerError(Loc::getMessage('INTERVOLGA_EDU.TEST_DUMP_NOT_FOUND'));
		}
	}
}