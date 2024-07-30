<?php
namespace Intervolga\Edu\Tests\Course1\Lesson2;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\DumpFunction;
use Intervolga\Edu\Locator\IO\FunctionFile;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\Regex;

class TestDumpAccess extends BaseTest
{
	protected static function run()
	{
		Assert::fileLocator(FunctionFile::class);
		Assert::functionExists(DumpFunction::class);

		if (DumpFunction::find() && FunctionFile::find()) {
			Assert::fileContentMatches(FunctionFile::find(), new Regex('/\$USER\s*->\s*(GetID\(\)\s*==\s*|IsAdmin)/i',
				Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_2.TEST_DUMP_ACCESS')));
		}
	}
}