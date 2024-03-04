<?php
namespace Intervolga\Edu\Tests\Course1New\Lesson3;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\Backup;

class TestBackupCheck extends BaseTest
{
	protected static function run()
	{
		$backupList = Backup::get();
		Assert::notEmpty($backupList, Loc::getMessage('IV_EDU.NEW_ACADEMY.C_1.L_3.NOT_FOUND_BACKUP'));
	}
}