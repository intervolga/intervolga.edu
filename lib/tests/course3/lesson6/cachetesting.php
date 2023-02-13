<?php
namespace Intervolga\Edu\Tests\Course3\Lesson6;

use Bitrix\Main\Localization\Loc;
use CIBlockElement;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\Iblock\RespondentIblock;
use Intervolga\Edu\Locator\Iblock\ResultsPollingIblock;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\DBHelper;

class CacheTesting extends BaseTest
{
	public static function interceptErrors()
	{
		return true;
	}

	protected static function run()
	{
		static::iblockTestCache(RespondentIblock::class);
		static::iblockTestCache(ResultsPollingIblock::class);
	}

	protected static function testCache($iblockId)
	{
		$element = CIBlockElement::GetList(false, ['IBLOCK_ID' => $iblockId])->fetch();
		$el = new CIBlockElement;
		$res = $el->Update($element['ID'], ['NAME' => $element['NAME']]);
		if ($res) {
			Assert::empty(DBHelper::getCacheFromTag('iblock_id_' . $iblockId['ID']));
		}
	}

	protected static function iblockTestCache($iblockLocator)
	{
		Assert::iblockLocator($iblockLocator);
		if ($pollResults = $iblockLocator::find()) {
			$cache = DBHelper::getCacheFromTag('iblock_id_' . $pollResults['ID']);
			Assert::notEmpty($cache, Loc::getMessage('INTERVOLGA_EDU.COURSE_3_LESSON_6_NOT_FOUND_CACHE',
				[
					'#TAG#' => 'iblock_id_' . $pollResults['ID'],
					'#IBLOCK_NAME#' => $iblockLocator::getNameLoc()
				]
			));
			static::testCache($pollResults['ID']);
		}
	}
}