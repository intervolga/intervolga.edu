<?php
namespace Intervolga\Edu\Tests\CourseOne\Lesson2;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Tests\BaseTest;

Loc::loadMessages(__FILE__);

class TestFiles extends BaseTest
{
	public static function getTitle()
	{
		return Loc::getMessage('INTERVOLGA_EDU.TEST_FILES') . ' (' . parent::getTitle() . ')';
	}

	public static function run()
	{
		static::registerError('Test');
	}
}