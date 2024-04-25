<?php
namespace Intervolga\Edu\Tests\Course2New\Lesson3;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\FileSystem;

class TestLocalTemplates extends BaseTest
{
	protected static function run()
	{
		Assert::directoryExists(FileSystem::getDirectory('/local/templates/main/'));
		Assert::directoryExists(FileSystem::getDirectory('/local/templates/inner/'));
		Assert::directoryExists(FileSystem::getDirectory('/local/templates/.default/'));
	}
}