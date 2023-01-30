<?php
namespace Intervolga\Edu\Tests\Course3\Lesson3;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\Iblock\Property\GenderProperty;
use Intervolga\Edu\Tests\BaseTest;

class TestPropertyGenderValues extends BaseTest
{
	protected static function run()
	{
		$prop = GenderProperty::find();
		$valuesName = [
			Loc::getMessage('INTERVOLGA_EDU.MALE'),
			Loc::getMessage('INTERVOLGA_EDU.FEMALE')
		];
		Assert::propertyTypeListHasValues($prop, $valuesName);
	}
}
