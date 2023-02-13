<?php
namespace Intervolga\Edu\Tests\Course3\Lesson7;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\Iblock\CustomProducts;
use Intervolga\Edu\Tests\BaseTestIblock;
use Intervolga\Edu\Util\Admin;
use Intervolga\Edu\Util\AdminFormOptions;

class IblockFullnessChecker extends BaseTestIblock
{
	const MIN_COUNT_CUSTOM_IBLOCK = 250;

	protected static function run()
	{
		Assert::iblockLocator(static::getLocator());
		if ($iblock = static::getLocator()::find()) {
			static::testElementsCount($iblock);
		}
	}

	protected static function getLocator()
	{
		return CustomProducts::class;
	}

	protected static function getMinCount(): int
	{
		return static::MIN_COUNT_CUSTOM_IBLOCK;
	}
}