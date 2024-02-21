<?php
namespace Intervolga\Edu\Tests\Course1New\Lesson3;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\UpdateSystem;

class TestUpdates extends BaseTest
{
	protected static function run()
	{
		$status = UpdateSystem::getStatus();
		Assert::empty($status['UPDATE_SYSTEM'], Loc::getMessage('INTERVOLGA_EDU.UPDATE_SYSTEM_FOUND'));
		Assert::count($status['MODULES'], 0);
	}
}