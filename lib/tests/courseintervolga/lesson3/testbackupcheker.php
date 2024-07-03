<?php
namespace Intervolga\Edu\Tests\CourseIntervolga\Lesson3;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\Backup;

class TestBackupCheker extends BaseTest
{
	const BACKUP_COUNT = 3;

	public static function interceptErrors()
	{
		return true;
	}

	protected static function run()
	{
		$backupList = Backup::get();
		Assert::notEmpty($backupList, Loc::getMessage('INTERVOLGA_EDU.COURSEINTERVOLGA_LESSON_3_NOT_FOUND_BACKUP'));
		static::checkBackupDate($backupList);
		Assert::lessEq(count($backupList), static::BACKUP_COUNT,
			Loc::getMessage('INTERVOLGA_EDU.COURSEINTERVOLGA_LESSON_3_BACKUP_COUNT'));
	}

	protected static function checkBackupDate($backupList)
	{
		$oldBackup = '';
		$validDate = date('d-m-Y', strtotime('-3 days'));
		foreach ($backupList as $backup) {
			$backupDate = date('d-m-Y', $backup['DATE']);
			if (strtotime($backupDate)<strtotime($validDate)) {
				$oldBackup .= Loc::getMessage('INTERVOLGA_EDU.COURSEINTERVOLGA_LESSON_3_OLD_BACKUP',
					[
						'#DATE#' => $backupDate,
						'#NAME#' => $backup['NAME'],
					]);
			}
		}
		Assert::empty($oldBackup, Loc::getMessage('INTERVOLGA_EDU.COURSEINTERVOLGA_LESSON_3_EXPIRED_DATE',
			[
				'#VALUE#' => $backupDate,
				'#EXPECT#' => $validDate,
				'#BACKUPS#' => $oldBackup,
			]
		));
	}
}