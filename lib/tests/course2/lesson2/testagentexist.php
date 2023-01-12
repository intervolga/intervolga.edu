<?php
namespace Intervolga\Edu\Tests\Course2\Lesson2;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\IO\AgentFile;
use Intervolga\Edu\Tests\BaseTest;

class TestAgentExist extends BaseTest
{
	protected static function run()
	{
		Assert::fileLocator(AgentFile::class);
	}
}