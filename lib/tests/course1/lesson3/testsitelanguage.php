<?php
namespace Intervolga\Edu\Tests\Course1\Lesson3;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\FileSystem;
use Intervolga\Edu\Util\Regex;

class TestSiteLanguage extends BaseTest
{
	protected static function run()
	{
		$headerFile = FileSystem::getFile('/local/templates/.default/include/header.php');
		$regex = new Regex('/\<html\s*lang\s*=\s*"\s*\<\?\s*\=\s*LANGUAGE_ID\s*\?\>"\>/i', '<html lang="<?=LANGUAGE_ID?>">');
		Assert::fileContentMatches($headerFile, $regex);
	}
}