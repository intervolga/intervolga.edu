<?php
namespace Intervolga\Edu\Tests\Course1\Lesson1;

use Bitrix\Main\Config\Option;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\UpdateSystem;

class TestUpdates extends BaseTest
{
	public static function run()
	{
		$lastUpdate = Option::get('main', 'update_system_update', '-');
		if ($status = UpdateSystem::getStatus()) {
			if ($status['MODULE']) {
				static::registerError(
					Loc::getMessage('INTERVOLGA_EDU.UPDATES_AVAILABLE',
						[
							'#COUNT#' => count($status['MODULE']),
							'#LAST_UPDATE#' => $lastUpdate,
						])
				);
			}
		}
	}
}