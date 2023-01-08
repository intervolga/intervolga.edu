<?php

namespace Intervolga\Edu\Tests\Course1\Lesson9;

use CIBlock;
use CIBlockElement;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\Iblock\ProductsIblock;
use Intervolga\Edu\Tests\BaseTest;

class TestSymbolicCode extends BaseTest
{
	protected static function run()
	{
		Assert::iblockLocator(ProductsIblock::class);

		$allIblock = CIblockElement::getList(false,['IBLOCK_ID' => ProductsIblock::find()['ID']],[]);
		$iblockWithoutCode = CIblockElement::getList(false,['IBLOCK_ID' => ProductsIblock::find()['ID'], '!CODE' => false], []);
		Assert::eq($allIblock, $iblockWithoutCode, 'Кол-во инфоблоков, у которых не заполнен символьный код: '.($allIblock-$iblockWithoutCode));

		$parameterCode = CIBlock::GetFields(ProductsIblock::find()['ID'])['CODE']['IS_REQUIRED'];
		Assert::eq($parameterCode, 'Y', 'Символьный код не является обязательным полем');

	}


}