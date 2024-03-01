<?php
namespace Intervolga\Edu\Tests\Course1New\Lesson3;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\FileSystem;

class TestSiteSupport extends BaseTest
{
	protected static function run() {
		Assert::fseExists(FileSystem::getFile("/local/php_interface/include/this_site_support.php"));
	}
}