<?php
namespace Intervolga\Edu\Tests\Course1\Lesson1;

use Intervolga\Edu\Assert;
use Intervolga\Edu\Tests\BaseTest;

class TestSiteCorporateModule extends BaseTest
{
	public static function run()
	{
		Assert::moduleInstalled('bitrix.sitecorporate');
	}
}