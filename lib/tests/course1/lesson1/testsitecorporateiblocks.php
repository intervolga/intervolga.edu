<?php
namespace Intervolga\Edu\Tests\Course1\Lesson1;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\Iblock\NewsIblock;
use Intervolga\Edu\Locator\Iblock\ProductsIblock;
use Intervolga\Edu\Tests\BaseTest;

class TestSiteCorporateIblocks extends BaseTest
{
	public static function interceptErrors()
	{
		return true;
	}

	protected static function run()
	{
		Assert::iblockLocator(ProductsIblock::class);
		Assert::iblockLocator(NewsIblock::class);
	}
}