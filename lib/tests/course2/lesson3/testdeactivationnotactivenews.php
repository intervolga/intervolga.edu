<?php
namespace Intervolga\Edu\Tests\Course2\Lesson3;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\Iblock\NewsIblock;
use Intervolga\Edu\Tests\BaseTestNewsElement;

class TestDeactivationNotActiveNews extends BaseTestNewsElement
{
	protected static function run()
	{
		Assert::iblockLocator(NewsIblock::class);
		if ($iblock = NewsIblock::find()) {
			static::cleanUp($iblock);

			try {
				$id = static::addElement($iblock, 'N');
				Assert::notEmpty($id, Loc::getMessage('INTERVOLGA_EDU.COURSE2_LESSON3_CREATE_NOT_ACTIVE_IB_FAILED'));
				$updateError = static::getErrorUpdateElement($id, ['ACTIVE' => 'N']);
				Assert::empty($updateError, Loc::getMessage('INTERVOLGA_EDU.COURSE2_LESSON3_NOT_ACTIVE_NEWS_DEACTIVATED'));
				static::cleanUp($iblock);
			} catch (\Throwable $t) {
				static::cleanUp($iblock);
				throw $t;
			}
		}
	}
}