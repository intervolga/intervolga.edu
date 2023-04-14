<?php
namespace Intervolga\Edu\Tests\CourseIntervolga\Lesson3;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\Buckup;

class BackupCheker extends BaseTest
{
	const BACKUP_COUNT = 3;

	protected static function run()
	{
		$backupList = Buckup::get();
		Assert::notEmpty($backupList, Loc::getMessage('INTERVOLGA_EDU.COURSEINTERVOLGA_LESSON_3_NOT_FOUND_BACKUP'));
		static::checkBackupDate($backupList);
		Assert::lessEq(count($backupList), static::BACKUP_COUNT,
			Loc::getMessage('INTERVOLGA_EDU.COURSEINTERVOLGA_LESSON_3_BACKUP_COUNT'));
	}

	protected static function checkBackupDate($backupList)
	{
		foreach ($backupList as $backup) {
			$validDate = date('d-m-Y', strtotime('-3 days'));
			$backupDate = date('d-m-Y', $backup['DATE']);
			Assert::greaterEq(strtotime($backupDate, strtotime($validDate)),
				Loc::getMessage('INTERVOLGA_EDU.COURSEINTERVOLGA_LESSON_3_EXPIRED_DATE',
					[
						'#VALUE#' => $validDate,
						'#EXPECT#' => $backupDate,
					]
				)
			);
		}
	}
}