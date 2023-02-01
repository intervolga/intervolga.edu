<?php
namespace Intervolga\Edu\Tests\Course2\Lesson3;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\Iblock\NewsIblock;
use Intervolga\Edu\Tests\BaseTestNewsElement;

class TestDeactivationActiveNews extends BaseTestNewsElement
{
	protected static function run()
	{
		Assert::iblockLocator(NewsIblock::class);
		if ($iblock = NewsIblock::find()) {
			static::cleanUp($iblock);

			try {
				$id = static::addActiveElement($iblock);
				Assert::notEmpty($id, Loc::getMessage('INTERVOLGA_EDU.COURSE2_LESSON3_CREATE_IB_FAILED'));
				$updateError = static::getErrorUpdateElement($id, ['ACTIVE' => 'N']);
				Assert::notEmpty($updateError, Loc::getMessage('INTERVOLGA_EDU.COURSE2_LESSON3_NEWS_DEACTIVATED'));
				Assert::notEq(
					$updateError,
					'Unknown error',
					Loc::getMessage('INTERVOLGA_EDU.COURSE2_LESSON3_NOT_FOUND_EXCEPTION')
				);
				static::cleanUp($iblock);
			} catch (\Throwable $t) {
				static::cleanUp($iblock);
				throw $t;
			}
		}
	}
}