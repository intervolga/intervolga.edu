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
			if ($license = $status['LICENSE']) {
				if ($license != Loc::getMessage('INTERVOLGA_EDU.LICENSE_NAME')) {
					static::registerError(Loc::getMessage('INTERVOLGA_EDU.INCORRECT_LICENSE', ['#LICENSE#' => $license]));
				}
			}
		}
	}
}