<?php
namespace Intervolga\Edu\Tests\Course1\Lesson3;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Util\BaseTest;
use Intervolga\Edu\Util\PathMask;
use Intervolga\Edu\Util\Regex;

class TestCustomCoreCheck extends BaseTest
{
	public static function run()
	{
		$files = static::getLessonFilesToCheck();
		$regex = new Regex('/B_PROLOG_INCLUDED ?=== ?true ?\|\| ?die(\(\))?/mi', 'B_PROLOG_INCLUDED === true || die()', Loc::getMessage('INTERVOLGA_EDU.CUSTOM_CORE_CHECK'));
		static::registerErrorIfFileContentNotFoundByRegex($files, [$regex]);
	}

	/**
	 * @return \Bitrix\Main\IO\FileSystemEntry[]
	 */
	public static function getLessonFilesToCheck(): array
	{
		$result = PathMask::getFileSystemEntriesByMasks([
			'/local/templates/main/header.php',
			'/local/templates/main/footer.php',
			'/local/templates/inner/header.php',
			'/local/templates/inner/footer.php',
		]);

		return $result;
	}
}