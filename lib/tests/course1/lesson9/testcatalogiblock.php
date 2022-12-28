<?php
namespace Intervolga\Edu\Tests\Course1\Lesson9;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\Iblock\ProductsIblock;
use Intervolga\Edu\Tests\BaseTest;

class TestCatalogIblock extends BaseTest
{
	protected static function run()
	{
		$fields = \CIBlock::GetArrayByID(ProductsIblock::find()['ID']);
		Assert::notEmpty($fields);
		$expectFields = static::getVariantUrl($fields);

		Assert::eq(
			$fields['LIST_PAGE_URL'],
			$expectFields['LIST_PAGE_URL'],
			Loc::getMessage('INTERVOLGA_EDU.LIST_PAGE_URL')
		);

		Assert::eq(
			$fields['DETAIL_PAGE_URL'],
			$expectFields['DETAIL_PAGE_URL'],
			Loc::getMessage('INTERVOLGA_EDU.DETAIL_PAGE_URL')
		);
		Assert::eq(
			$fields['SECTION_PAGE_URL'],
			$expectFields['SECTION_PAGE_URL'],
			Loc::getMessage('INTERVOLGA_EDU.SECTION_PAGE_URL')
		);
	}

	private static function getVariantUrl($fields)
	{
		if (substr_count($fields['LIST_PAGE_URL'], '/') == 2) {
			$expect['LIST_PAGE_URL'] = '#SITE_DIR#/products/';
		} else {
			$expect['LIST_PAGE_URL'] = '#SITE_DIR#products/';
		}
		if (substr_count($fields['DETAIL_PAGE_URL'], '/') == 4) {
			$expect['DETAIL_PAGE_URL'] = '#SITE_DIR#/products/#SECTION_CODE#/#CODE#/';
		} else {
			$expect['DETAIL_PAGE_URL'] = '#SITE_DIR#products/#SECTION_CODE#/#CODE#/';
		}
		if (substr_count($fields['SECTION_PAGE_URL'], '/') == 3) {
			$expect['SECTION_PAGE_URL'] = '#SITE_DIR#/products/#SECTION_CODE#/';
		} else {
			$expect['SECTION_PAGE_URL'] = '#SITE_DIR#products/#SECTION_CODE#/';
		}

		return $expect;

	}
}