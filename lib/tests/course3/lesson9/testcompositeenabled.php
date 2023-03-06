<?php
namespace Intervolga\Edu\Tests\Course3\Lesson9;

use Bitrix\Main\Composite\Helper as CompositeHelper;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Asserts\AssertComponent;
use Intervolga\Edu\Locator\Component\AuthForm;
use Intervolga\Edu\Locator\Component\Template\PhoneIncludeArea;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\Regex;

class TestCompositeEnabled extends BaseTest
{
	protected static function run()
	{
		Assert::true(
			CompositeHelper::isCompositeEnabled(),
			Loc::getMessage('INTERVOLGA_EDU.COURSE_3_LESSON_9_COMPOSITE_DISABLE')
		);
		Assert::matches(
			CompositeHelper::getOptions()['INCLUDE_MASK'],
			new Regex('/products/i', 'products'),
			Loc::getMessage('INTERVOLGA_EDU.COURSE_3_LESSON_9_INCLUDE_MASK')
		);

		AssertComponent::templateLocator(PhoneIncludeArea::class);
		static::checkCompositeArea(PhoneIncludeArea::class);

		AssertComponent::componentLocator(AuthForm::class);
		static::checkCompositeArea(AuthForm::class);
	}

	protected static function checkCompositeArea($compositeArea)
	{
		if ($compositeArea::find()) {
			Assert::eq(
				$compositeArea::find()['PARAMETERS']['COMPOSITE_FRAME_MODE'],
				'A',
				Loc::getMessage(
					'INTERVOLGA_EDU.COURSE_3_LESSON_9_COMPOSITE_FRAME_MODE',
					[
						'#COMPONENT_NAME#' => $compositeArea::getNameLoc()
					]
				)
			);
		}
	}
}