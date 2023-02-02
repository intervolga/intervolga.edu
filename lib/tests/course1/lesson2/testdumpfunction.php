<?php
namespace Intervolga\Edu\Tests\Course1\Lesson2;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\DumpFunction;
use Intervolga\Edu\Tests\BaseTest;

class TestDumpFunction extends BaseTest
{
	protected static function run()
	{
		Assert::functionExists(DumpFunction::class);
	}
}