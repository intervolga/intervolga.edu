<?php
namespace Intervolga\Edu\Tests\Course3\Lesson2;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\Module\AdminFiles\EditFile;
use Intervolga\Edu\Locator\Module\AdminFiles\TableFile;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\Regex;

class ContentPageChecker extends BaseTest
{
	public static function interceptErrors()
	{
		return true;
	}

	protected static function run()
	{
		Assert::fseExists(EditFile::find());
		Assert::fileNotEmpty(EditFile::find());
		if (EditFile::find()) {
			Assert::fileContentMatches(EditFile::find(), new Regex('/<input/i', '<input'));
			Assert::fileContentMatches(EditFile::find(), new Regex('/<td/i', '<td'));
		}

		Assert::fseExists(TableFile::find());
		Assert::fileNotEmpty(TableFile::find());
		if (TableFile::find()) {
			Assert::fileContentMatches(TableFile::find(), new Regex('/<input/i', '<input'));
			Assert::fileContentMatches(TableFile::find(), new Regex('/<td/i', '<td'));
		}
	}
}