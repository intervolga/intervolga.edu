<?php
namespace Intervolga\Edu\Tests\Course1\Lesson1;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\Registry\Iblock\NewsIblock;
use Intervolga\Edu\Util\Registry\Iblock\ProductsIblock;

class TestSiteCorporateIblocks extends BaseTest
{
	public static function interceptErrors()
	{
		return true;
	}

	protected static function run()
	{
		Assert::registryIblock(ProductsIblock::class);
		Assert::registryIblock(NewsIblock::class);
	}
}