<?php
namespace Intervolga\Edu\Tests\Course1\Lesson3;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Util\BaseTest;
use Intervolga\Edu\Util\Regex;

class TestLongPhpTag extends BaseTest
{
	public static function run()
	{
		$regexes = [
			new Regex(
				'/<\?[^=p].*/m',
				'<?',
				Loc::getMessage('INTERVOLGA_EDU.SHORT_PHP_TAG_RESTRICTED')
			),
		];

		$files = TestCustomCoreCheck::getLessonFilesToCheck();
		static::registerErrorIfFileContentFoundByRegex($files, $regexes);
	}
}