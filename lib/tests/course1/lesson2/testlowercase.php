<?php
namespace Intervolga\Edu\Tests\Course1\Lesson2;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Util\BaseTest;
use Intervolga\Edu\Util\FileSystem;
use Intervolga\Edu\Util\PathMask;
use Intervolga\Edu\Util\Regex;

class TestLowerCase extends BaseTest
{
	public static function run()
	{
		$publicDirs = FileSystem::getPublicDirsLevelOne();
		$entriesToCheck = PathMask::getFileSystemEntriesByMasks(
			[
				'*',
				'*/',
				'*/*',
				'*/*/',
				'*/*/*',
				'*/*/*/',
				'*/*/*/*',
				'*/*/*/*/',
				'*/*/*/*/*',
				'*/*/*/*/*/',
				'*/*/*/*/*/*',
				'*/*/*/*/*/*/',// let it snow, let it snow, let it snow!
			],
			$publicDirs
		);
		$entriesToCheck = array_merge($entriesToCheck, PathMask::getFileSystemEntriesByMask('*'));
		$entriesToCheck = array_merge($entriesToCheck, $publicDirs);

		$regexes = [
			new Regex('/[A-Z]/u', Loc::getMessage('INTERVOLGA_EDU.UPPER_CASE_LETTERS'), Loc::getMessage('INTERVOLGA_EDU.NOT_LOWER_CASE')),
		];

		static::registerErrorForFileSystemEntriesNameMatch($entriesToCheck, $regexes);
	}
}