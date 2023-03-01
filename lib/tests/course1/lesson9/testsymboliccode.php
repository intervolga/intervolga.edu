<?php
namespace Intervolga\Edu\Tests\Course1\Lesson9;

use Bitrix\Main\Localization\Loc;
use CIBlock;
use CIBlockElement;
use CIBlockSection;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\Iblock\ProductsIblock;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\Admin;

class TestSymbolicCode extends BaseTest
{
	public static function interceptErrors()
	{
		return true;
	}

	protected static function run()
	{
		Assert::iblockLocator(ProductsIblock::class);
		if ($iblock = ProductsIblock::find()) {
			static::checkFields($iblock);
			static::checkSectionsCodes($iblock);
			static::checkElementsCodes($iblock);
		}
	}

	protected static function checkFields(array $iblock)
	{
		$fields = CIBlock::getFields($iblock['ID']);
		Assert::eq(
			$fields['CODE']['IS_REQUIRED'],
			'Y',
			Loc::getMessage(
				'INTERVOLGA_EDU.COURSE_1_LESSON_1_9_CODE_IS_REQUIRED', [
					'#IBLOCK_LINK#' => Admin::getIblockUrl($iblock),
					'#IBLOCK#' => $iblock['NAME'],
				]
			)
		);
		Assert::eq(
			$fields['CODE']['DEFAULT_VALUE']['UNIQUE'],
			'Y',
			Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_1_9_FIELD_UNIQUE', [
				'#IBLOCK_LINK#' => Admin::getIblockUrl($iblock),
				'#IBLOCK#' => $iblock['NAME'],
			])
		);
		Assert::eq(
			$fields['CODE']['DEFAULT_VALUE']['TRANSLITERATION'],
			'Y',
			Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_1_9_FIELD_TRANSLITERATION', [
				'#IBLOCK_LINK#' => Admin::getIblockUrl($iblock),
				'#IBLOCK#' => $iblock['NAME'],
			])
		);
		Assert::eq(
			$fields['SECTION_CODE']['IS_REQUIRED'],
			'Y',
			Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_1_9_SECTION_CODE_IS_REQUIRED', [
				'#IBLOCK_LINK#' => Admin::getIblockUrl($iblock),
				'#IBLOCK#' => $iblock['NAME'],
			])
		);
	}

	protected static function checkSectionsCodes(array $iblock)
	{
		$sectionsCode = CIBlockSection::getList(false, ['IBLOCK_ID' => $iblock['ID']]);
		while ($section = $sectionsCode->fetch()) {
			Assert::notEmpty(
				$section['CODE'],
				Loc::getMessage(
					'INTERVOLGA_EDU.COURSE_1_LESSON_1_9_SECTION_CODE_IS_EMPTY',
					[
						'#SECTION_LINK#' => Admin::getIblockSectionUrl($section),
						'#SECTION#' => $section['NAME'],
						'#IBLOCK_LINK#' => Admin::getIblockUrl($iblock),
						'#IBLOCK#' => $iblock['NAME'],
					]
				)
			);
		}
	}

	protected static function checkElementsCodes(array $iblock)
	{
		$allIblock = CIblockElement::getList(false, ['IBLOCK_ID' => $iblock['ID']], []);
		$iblockWithoutCode = CIblockElement::getList(
			false,
			[
				'IBLOCK_ID' => $iblock['ID'],
				'!CODE' => false
			],
			[]
		);
		Assert::eq(
			$allIblock,
			$iblockWithoutCode,
			Loc::getMessage(
				'INTERVOLGA_EDU.COURSE_1_LESSON_1_9_CODE_IS_EMPTY', [
					'#COUNT#' => ($allIblock - $iblockWithoutCode),
					'#IBLOCK_LINK#' => Admin::getIblockUrl($iblock),
					'#IBLOCK#' => $iblock['NAME'],
				]
			)
		);
	}
}