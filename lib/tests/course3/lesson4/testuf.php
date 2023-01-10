<?php
namespace Intervolga\Edu\Tests\Course3\Lesson4;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\Event;
use Intervolga\Edu\Tests\BaseTest;

class TestUf extends BaseTest
{
	protected static function run()
	{
		Assert::eventExists(Event\MediaType::class);
	}
}
