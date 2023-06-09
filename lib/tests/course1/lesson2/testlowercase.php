<?php
namespace Intervolga\Edu\Tests\Course1\Lesson2;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\PathMaskParser;
use Intervolga\Edu\Util\Paths;
use Intervolga\Edu\Util\Regex;

class TestLowerCase extends BaseTest
{
	public static function interceptErrors()
	{
		return true;
	}

	protected static function run()
	{
		$publicDirs = Paths::getPublicDirsLevelOne();
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

		$regex = new Regex(
			'/^[a-z0-9_\-.]+$/u',
			Loc::getMessage('INTERVOLGA_EDU.NOT_LOWER_CASE')
		);

		foreach ($entriesToCheck as $fse) {
			Assert::fseNameMatches($fse, $regex);
		}
	}
}