<?php
namespace Intervolga\Edu\Tests\Course3\Lesson9;

use Bitrix\Main\Component\ParametersTable;
use Bitrix\Main\Composite\Helper;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Asserts\AssertComponent;
use Intervolga\Edu\Locator\Component\AuthForm;
use Intervolga\Edu\Locator\Component\Template\MobilePhoneIncludeArea;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\Regex;

class CompositeEnabled extends BaseTest
{
	protected static function run()
	{
		Assert::true(Helper::isCompositeEnabled(), Loc::getMessage('INTERVOLGA_EDU.COURSE_3_LESSON_9_COMPOSITE_DISABLE'));
		Assert::matches(Helper::getOptions()['INCLUDE_MASK'], new Regex('/products/i', 'products'),
			Loc::getMessage('INTERVOLGA_EDU.COURSE_3_LESSON_9_INCLUDE_MASK'));

		AssertComponent::templateLocator(MobilePhoneIncludeArea::class);
		if (MobilePhoneIncludeArea::find()) {
			Assert::eq(MobilePhoneIncludeArea::find()['PARAMETERS']['COMPOSITE_FRAME_MODE'], 'A',
				Loc::getMessage('INTERVOLGA_EDU.COURSE_3_LESSON_9_COMPOSITE_FRAME_MODE',
					[
						'#COMPONENT_NAME#' => MobilePhoneIncludeArea::getNameLoc()
					]
				)
			);
		}

		AssertComponent::templateLocator(AuthForm::class);
		if (AuthForm::find()) {
			Assert::eq(AuthForm::find()['PARAMETERS']['COMPOSITE_FRAME_MODE'], 'A',
				Loc::getMessage('INTERVOLGA_EDU.COURSE_3_LESSON_9_COMPOSITE_FRAME_MODE',
					[
						'#COMPONENT_NAME#' => AuthForm::getNameLoc()
					]
				)
			);
		}
	}
}