<?php
namespace Intervolga\Edu\Tests\Course1\Lesson9;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\Iblock\ProductsIblock;
use Intervolga\Edu\Tests\BaseTest;

class TestCatalogIblock extends BaseTest
{
	public static function interceptErrors()
	{
		return true;
	}

	protected static function run()
	{
		Assert::iblockLocator(ProductsIblock::class);
		if ($iblock = ProductsIblock::find()) {
			Assert::eq(
				static::prepareUrl($iblock['LIST_PAGE_URL']),
				'#SITE_DIR#products/',
				Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_1_9_ASSERT_EQUAL_LIST_PAGE_URL')
			);

			Assert::eq(
				static::prepareUrl($iblock['DETAIL_PAGE_URL']),
				'#SITE_DIR#products/#SECTION_CODE#/#CODE#/',
				Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_1_9_ASSERT_EQUAL_DETAIL_PAGE_URL')
			);
			Assert::eq(
				static::prepareUrl($iblock['SECTION_PAGE_URL']),
				'#SITE_DIR#products/#SECTION_CODE#/',
				Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_1_9_ASSERT_EQUAL_SECTION_PAGE_URL')
			);
		}
	}

	protected static function prepareUrl($url)
	{
		return str_replace('#SITE_DIR#/', '#SITE_DIR#', $url);
	}
}