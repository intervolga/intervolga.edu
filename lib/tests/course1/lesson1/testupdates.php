<?php
namespace Intervolga\Edu\Tests\Course1\Lesson1;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\UpdateSystem;

class TestUpdates extends BaseTest
{
	protected static function run()
	{
		$status = UpdateSystem::getStatus();

		if (is_int($status['MODULES']) || is_array($status['MODULES'])) {
			Assert::count($status['MODULES'], 0);
		} else {
			Assert::custom(Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_1_TEST_ERROR',
				[
					'#MESSAGE#' => $status['MODULES']
				]));
		}
	}
}