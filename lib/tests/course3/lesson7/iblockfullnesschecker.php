<?php
namespace Intervolga\Edu\Tests\Course3\Lesson7;

use Bitrix\Main\Localization\Loc;
use CIBlockSection;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\Iblock\CustomProducts;
use Intervolga\Edu\Tests\BaseTestIblock;
use Intervolga\Edu\Util\Admin;

class IblockFullnessChecker extends BaseTestIblock
{
	const MIN_COUNT_CUSTOM_IBLOCK = 200;
	const MIN_COUNT_CUSTOM_SECTIONS = 5;

	protected static function run()
	{
		Assert::iblockLocator(static::getLocator());
		if ($iblock = static::getLocator()::find()) {
			static::testElementsCount($iblock);
			static::testSectionsCount($iblock);
		}
	}

	protected static function getLocator()
	{
		return CustomProducts::class;
	}

	protected static function testSectionsCount(array $iblock)
	{
		Assert::greaterEq(CIBlockSection::GetCount(['IBLOCK_CODE' => static::getLocator()::find()['CODE']]),
			static::MIN_COUNT_CUSTOM_SECTIONS,
			Loc::getMessage(
				'INTERVOLGA_EDU.SECTION_COUNT',
				[
					'#IBLOCK_LINK#' => Admin::getIblockElementsUrl($iblock),
					'#IBLOCK#' => $iblock['NAME'],
					'#EXPECT#' => static::MIN_COUNT_CUSTOM_SECTIONS,
				]
			));
	}

	protected static function getMinCount(): int
	{
		return static::MIN_COUNT_CUSTOM_IBLOCK;
	}
}