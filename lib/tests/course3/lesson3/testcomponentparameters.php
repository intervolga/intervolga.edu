<?php
namespace Intervolga\Edu\Tests\Course3\Lesson3;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Asserts\AssertComponent;
use Intervolga\Edu\Locator\Component\RespondentsComponent;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\ComponentParameters;

class TestComponentParameters extends BaseTest
{
	const requiredProperties = [
		'AGE',
		'SALARY',
		'GENDER'
	];

	public static function interceptErrors()
	{
		return true;
	}

	protected static function run()
	{
		AssertComponent::componentLocator($component = RespondentsComponent::class);
		if ($component::find()) {
			$properties = ComponentParameters::getComponentParameters($component::find()['COMPONENT_NAME'])['PROPERTIES'];
			$add = array_diff(static::requiredProperties, $properties);
			$delete = array_diff($properties, static::requiredProperties);
			Assert::empty($add, Loc::getMessage('INTERVOLGA_EDU.COURSE_3_LESSON_3.ADD_PROPS', ['#PROPS#' => implode(', ', $add)]));
			Assert::empty($delete, Loc::getMessage('INTERVOLGA_EDU.COURSE_3_LESSON_3.DELETE_PROPS', ['#PROPS#' => implode(', ', $delete)]));
		}
	}
}