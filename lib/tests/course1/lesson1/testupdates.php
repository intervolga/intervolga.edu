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
		Assert::empty(
			$status['MODULE'],
			Loc::getMessage(
				'INTERVOLGA_EDU.UPDATES_AVAILABLE',
				[
					'#COUNT#' => count($status['MODULE']),
					'#LAST_UPDATE#' => Option::get('main', 'update_system_update', '-'),
				]
			)
		);
	}
}