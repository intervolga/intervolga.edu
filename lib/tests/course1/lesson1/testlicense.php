<?php
namespace Intervolga\Edu\Tests\Course1\Lesson1;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\UpdateSystem;

class TestLicense extends BaseTest
{
	public static function checkLastResult(): bool
	{
		return true;
	}

	protected static function run()
	{
		$status = UpdateSystem::getStatus();
		Assert::eq(
			$status['LICENSE'],
			Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_1_LICENSE_NAME')
		);
	}
}