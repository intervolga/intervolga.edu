<?php
namespace Intervolga\Edu\Tests\Course1\Lesson9;

use Bitrix\Main\Localization\Loc;
use CIBlock;
use CIBlockElement;
use CIBlockSection;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\Iblock\ProductsIblock;
use Intervolga\Edu\Tests\BaseTest;

class TestSymbolicCode extends BaseTest
{
	protected static function run()
	{
		Assert::iblockLocator(ProductsIblock::class);

		$parameterCode = CIBlock::GetFields(ProductsIblock::find()['ID'])['CODE']['IS_REQUIRED'];
		Assert::eq($parameterCode, 'Y', Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_1_9_CODE_IS_REQUIRED'));

		$sectionsCode = CIBlockSection::GetList(false, ['IBLOCK_ID' => ProductsIblock::find()['ID']]);
		while ($section = $sectionsCode->fetch()) {
			Assert::notEmpty($section['CODE'], Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_1_9_SECTION_CODE_IS_EMPTY', ['#NAME#' => $section['NAME']]));
		}

		$allIblock = CIblockElement::getList(false, ['IBLOCK_ID' => ProductsIblock::find()['ID']], []);
		$iblockWithoutCode = CIblockElement::getList(false, [
			'IBLOCK_ID' => ProductsIblock::find()['ID'],
			'!CODE' => false
		], []);
		Assert::eq($allIblock, $iblockWithoutCode, Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_1_9_CODE_IS_EMPTY') . ($allIblock - $iblockWithoutCode));

	}

}