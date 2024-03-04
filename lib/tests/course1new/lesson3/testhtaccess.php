<?php
namespace Intervolga\Edu\Tests\Course1New\Lesson3;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\FileSystem;
use Intervolga\Edu\Util\Regex;

class TestHtaccess extends BaseTest
{
	public static function interceptErrors()
	{
		return true;
	}

	public static function run()
	{
		Assert::fseExists(FileSystem::getFile("/.htaccess"));
		Assert::fseExists(FileSystem::getFile("/.htpasswd"));

		Assert::fileContentMatches(FileSystem::getFile("/.htaccess"),
			new Regex('/\s*AuthType\s*Basic\s*AuthName\s*"Authorization"\s*AuthUserFile\s*\/home\/bitrix\/www\/\.htpasswd\s*Require\s*valid-user/i',
				Loc::getMessage('IV_EDU.NEW_ACADEMY.C_1.L_3.HTACCESS')));
	}
}