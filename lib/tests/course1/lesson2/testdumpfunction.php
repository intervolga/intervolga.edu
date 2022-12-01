<?php
namespace Intervolga\Edu\Tests\Course1\Lesson2;

use Intervolga\Edu\Assert;
use Intervolga\Edu\Tests\BaseTest;

class TestDumpFunction extends BaseTest
{
	public static function run()
	{
		Assert::functionExists('test_dump');
	}
}