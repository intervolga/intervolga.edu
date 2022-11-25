<?php
namespace Intervolga\Edu\Tests\Course1\Lesson3;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Util\BaseTest;
use Intervolga\Edu\Util\Fileset;
use Intervolga\Edu\Util\FileSystem;
use Intervolga\Edu\Util\Regex;

class TestCustomCoreCheck extends BaseTest
{
	public static function run()
	{
		$files = static::getLessonFilesToCheck();
		$fileset = new Fileset($files);
		$regex = new Regex('/B_PROLOG_INCLUDED ?=== ?true ?\|\| ?die(\(\))?/mi', 'B_PROLOG_INCLUDED === true || die()', Loc::getMessage('INTERVOLGA_EDU.CUSTOM_CORE_CHECK'));
		static::testFilesetContentNotFoundByRegex($fileset, [$regex]);
	}

	/**
	 * @return \Bitrix\Main\IO\FileSystemEntry[]
	 */
	protected static function getLessonFilesToCheck()
	{
		$templatesToCheck = [
			'/local/templates/',
			[
				'main/',
				'inner/'
			],
			[
				'header.php',
				'footer.php'
			]
		];

		return FileSystem::getComboEntries($templatesToCheck);
	}
}