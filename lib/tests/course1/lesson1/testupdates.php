<?php
namespace Intervolga\Edu\Tests\Course1\Lesson1;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\UpdateSystem;

class TestUpdates extends BaseTest
{
	protected static function run()
	{
		$status = UpdateSystem::getStatus();

		Assert::eq(
			count($status['MODULES']),
			0
		);
	}
}