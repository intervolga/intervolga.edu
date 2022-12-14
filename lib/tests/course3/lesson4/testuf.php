<?php
namespace Intervolga\Edu\Tests\Course3\Lesson4;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Locator\Event;

class TestUf extends BaseTest
{
	protected static function run()
	{
		// Есть вероятность, что ложно сработает, если класс будет назван так же
		Assert::moduleEventExists(Event\MediaType::class);
	}
}
