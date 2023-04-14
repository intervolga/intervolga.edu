<?php
namespace Intervolga\Edu\Tests\Course3\Lesson6;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\Iblock\RespondentIblock;
use Intervolga\Edu\Locator\Iblock\ResultsPollingIblock;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\CacheTagTable;

class TestCacheTesting extends BaseTest
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

	protected static function iblockTestCache($iblockLocator)
	{
		Assert::iblockLocator($iblockLocator);
		if ($pollResults = $iblockLocator::find()) {
			$cache = CacheTagTable::getCount(['TAG' => 'iblock_id_' . $pollResults['ID']]);
			Assert::greater($cache, 0, Loc::getMessage('INTERVOLGA_EDU.COURSE_3_LESSON_6_NOT_FOUND_CACHE',
				[
					'#TAG#' => 'iblock_id_' . $pollResults['ID'],
					'#IBLOCK_NAME#' => $iblockLocator::getNameLoc()
				]
			));
		}
	}
}