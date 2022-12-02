<?php
namespace Intervolga\Edu\Tests\Course1\Lesson1;

use Intervolga\Edu\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\FileSystem;

class TestSiteCorporateSections extends BaseTest
{
	public static function interceptErrors()
	{
		return true;
	}

	public static function run()
	{
		Assert::directoryExists(FileSystem::getDirectory('/1products/'));
		Assert::directoryExists(FileSystem::getDirectory('/1company/'));
		Assert::directoryExists(FileSystem::getDirectory('/contacts/'));
	}
}