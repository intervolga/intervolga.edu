<?php
namespace Intervolga\Edu\Tests\Course1\Lesson3;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\FileSystem;
use Intervolga\Edu\Util\Regex;

class TestInnerTitle extends BaseTest
{
	protected static function run()
	{
		$headerFile = FileSystem::getFile('/local/templates/inner/header.php');
		$regex = new Regex('/\$APPLICATION\s*->\s*ShowTitle\s*\(\s*false\s*\)\s*/i',
			'$APPLICATION->ShowTitle(false)');
		Assert::fileContentMatches($headerFile, $regex);
	}
}