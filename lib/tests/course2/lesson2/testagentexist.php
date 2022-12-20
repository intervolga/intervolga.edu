<?php
namespace Intervolga\Edu\Tests\Course2\Lesson2;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\FileSystem;

class TestAgentExist extends BaseTest
{
	protected static function run()
	{
		Assert::fseExists(FileSystem::getFile('/local/php_interface/agent.php'));

	}

}