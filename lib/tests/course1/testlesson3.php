<?php
namespace Intervolga\Edu\Tests\Course1;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Tests\BaseTest;

Loc::loadMessages(__FILE__);

class TestLesson3 extends BaseTest
{
	public static function getTitle()
	{
		return Loc::getMessage('INTERVOLGA_EDU.TEST_COURSE_1_LESSON_3');
	}

	public static function run()
	{
		static::registerError('Test');
	}
}