<?php
namespace Intervolga\Edu\Tests\Course2New\Lesson3;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\FileSystem;

class TestLangFile extends BaseTest
{
	public static function interceptErrors()
	{
		return true;
	}

	protected static function run()
	{
		$headerFile =  FileSystem::getFile('/local/templates/inner/lang/ru/header.php');
		Assert::langCodeExists($headerFile, 'ACADEMY_INNER_ABOUT_CONTRACT');
	}
}