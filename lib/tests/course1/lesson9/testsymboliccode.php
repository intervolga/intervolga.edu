<?php

namespace Intervolga\Edu\Tests\Course1\Lesson9;

use CIBlockElement;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\Iblock\ProductsIblock;
use Intervolga\Edu\Tests\BaseTest;

class TestSymbolicCode extends BaseTest
{
	protected static function run()
	{
		Assert::iblockLocator(ProductsIblock::class);
		$ib = ProductsIblock::find();
		static::getIblockParameter();

		$allIblock = CIblockElement::getList(false,['IBLOCK_ID' => ProductsIblock::find()['ID']],[]);
		$iblockWithoutCode = CIblockElement::getList(false,['IBLOCK_ID' => ProductsIblock::find()['ID'], '!CODE' => false], []);
		Assert::eq($allIblock, $iblockWithoutCode, 'Кол-во инфоблоков, у которых не заполнен символьный код: '.($allIblock-$iblockWithoutCode));
	}

	public static function getIblockParameter()
	{

	}
}