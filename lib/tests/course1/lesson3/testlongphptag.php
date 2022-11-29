<?php
namespace Intervolga\Edu\Tests\Course1\Lesson3;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Util\BaseTest;
use Intervolga\Edu\Util\Fileset;
use Intervolga\Edu\Util\Regex;

class TestLongPhpTag extends BaseTest
{
	public static function run()
	{
		$regexes = [
			new Regex('/<\?[^=p].*/m', '<?', '<?php'),
		];

		$files = TestCustomCoreCheck::getLessonFilesToCheck();
		static::testFilesetContentByRegex($files, $regexes, Loc::getMessage('INTERVOLGA_EDU.SHORT_PHP_TAG_RESTRICTED'));
	}
}