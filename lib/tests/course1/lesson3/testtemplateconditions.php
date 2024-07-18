<?php
namespace Intervolga\Edu\Tests\Course1\Lesson3;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\FileSystem;

class TestTemplateConditions extends BaseTest
{
	public static function interceptErrors()
	{
		return true;
	}

	protected static function run()
	{
		Assert::directoryExists(FileSystem::getDirectory('/local/templates/main'),
			Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_3.DIRECTORY_NOT_FOUND'));
		Assert::directoryExists(FileSystem::getDirectory('/local/templates/inner'),
			Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_3.DIRECTORY_NOT_FOUND'));

		Assert::templateEqCondition('main', 'CSite::InDir(\'/index.php\')');
		Assert::templateEqCondition('inner', '');
	}
}