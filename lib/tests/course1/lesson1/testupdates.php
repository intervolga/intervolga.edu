<?php
namespace Intervolga\Edu\Tests\Course1\Lesson1;

use Bitrix\Main\Config\Option;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\UpdateSystem;

class TestUpdates extends BaseTest
{
	public static function run()
	{
		$status = UpdateSystem::getStatus();

		Assert::eq(
			count($status['MODULES']),
			0
		);
	}
}