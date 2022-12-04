<?php
namespace Intervolga\Edu\Tests\Course1\Lesson41;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\IO\IncludeAreaFile;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\FileSystem;

class TestIncludeArea extends BaseTest
{
	protected static function run()
	{
		Assert::fileLocator(IncludeAreaFile::class);
		$file = IncludeAreaFile::find();
		$fileInRoot = FileSystem::getFile('/' . $file->getName());
		Assert::fseExists($fileInRoot);
	}
}
