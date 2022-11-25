<?php
namespace Intervolga\Edu\Tests\Course1\Lesson3;

use Bitrix\Main\Application;
use Bitrix\Main\IO\Directory;
use Bitrix\Main\IO\File;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Util\Admin;
use Intervolga\Edu\Util\BaseTest;
use Intervolga\Edu\Util\Fileset;
use Intervolga\Edu\Util\FileSystem;
use Intervolga\Edu\Util\Regex;

class TestLongPhpTag extends BaseTest
{
	public static function run()
	{
		$regexes = [
			new Regex('/<\?[^=p].*/m', '<?', '<?php'),
		];

		$files = TestCustomCoreCheck::getLessonFilesToCheck();
		$fileset = new Fileset($files);
		static::testFilesetContentByRegex($fileset, $regexes, Loc::getMessage('INTERVOLGA_EDU.SHORT_PHP_TAG_RESTRICTED'));
	}
}