<?php
namespace Intervolga\Edu\Tests\Course1\Lesson2;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\IO\PromoSection;
use Intervolga\Edu\Tests\BaseTest;

class TestPromo extends BaseTest
{
	protected static function run()
	{
		Assert::directoryLocator(PromoSection::class);
	}
}