<?php
namespace Intervolga\Edu\Tests\Course1\Lesson1;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\UpdateSystem;

class TestLicense extends BaseTest
{
	public static function run()
	{
		$status = UpdateSystem::getStatus();
		Assert::eq(
			$status['LICENSE'],
			Loc::getMessage('INTERVOLGA_EDU.LICENSE_NAME')
		);
	}
}