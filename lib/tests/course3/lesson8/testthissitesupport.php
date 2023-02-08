<?php
namespace Intervolga\Edu\Tests\Course3\Lesson8;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\FileSystem;

class TestThisSiteSupport extends BaseTest
{
	protected static function run()
	{
		$file = FileSystem::getFile('/local/php_interface/this_site_support.php');
		Assert::fseExists($file);
		Assert::fileNotEmpty($file);
	}
}