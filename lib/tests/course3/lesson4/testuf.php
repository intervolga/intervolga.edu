<?php
namespace Intervolga\Edu\Tests\Course3\Lesson4;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Locator\Event;
use Intervolga\Edu\Locator\UserField;

class TestUf extends BaseTest
{
	protected static function run()
	{
		Assert::moduleEventExists(Event\MediaType::class);
	}
}
