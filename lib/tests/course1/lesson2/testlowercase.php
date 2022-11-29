<?php
namespace Intervolga\Edu\Tests\Course1\Lesson2;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\PathMaskParser;
use Intervolga\Edu\Util\PathsRegistry;
use Intervolga\Edu\Util\Regex;

class TestLowerCase extends BaseTest
{
	public static function run()
	{
		$publicDirs = PathsRegistry::getPublicDirsLevelOne();
		$entriesToCheck = PathMaskParser::getFileSystemEntriesByMasks(
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
		$entriesToCheck = array_merge($entriesToCheck, PathMaskParser::getFileSystemEntriesByMask('*'));
		$entriesToCheck = array_merge($entriesToCheck, $publicDirs);

		$regexes = [
			new Regex('/[A-Z]/u', Loc::getMessage('INTERVOLGA_EDU.UPPER_CASE_LETTERS'), Loc::getMessage('INTERVOLGA_EDU.NOT_LOWER_CASE')),
		];

		static::registerErrorForFileSystemEntriesNameMatch($entriesToCheck, $regexes);
	}
}