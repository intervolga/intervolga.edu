<?php
namespace Intervolga\Edu\Tests\Course1\Lesson1;

use Intervolga\Edu\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\Registry\Iblock\NewsIblock;
use Intervolga\Edu\Util\Registry\Iblock\ProductsIblock;

class TestSiteCorporateIblocks extends BaseTest
{
	public static function run()
	{
		Assert::interceptErrorsOn();
		Assert::registryIblock(ProductsIblock::class);
		Assert::registryIblock(NewsIblock::class);
		Assert::interceptErrorsOff();
		Assert::throwIntercepted();
	}
}