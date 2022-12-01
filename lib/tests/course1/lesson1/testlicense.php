<?php
namespace Intervolga\Edu\Tests\Course1\Lesson1;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\UpdateSystem;

class TestLicense extends BaseTest
{
	public static function run()
	{
		if ($status = UpdateSystem::getStatus()) {
			static::assertEq(
				$status['LICENSE'],
				Loc::getMessage('INTERVOLGA_EDU.LICENSE_NAME')
			);
		}
	}
}