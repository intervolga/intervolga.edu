<?php
namespace Intervolga\Edu\Tests\Course2\Lesson1_2;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Asserts\AssertComponent;
use Intervolga\Edu\Locator\Component\Template\Slider;
use Intervolga\Edu\Locator\IO\MainHeaderTemplate;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\Regex;

class TestComponentInclude extends BaseTest
{
	const REG_INCLUDE_SLIDER = '/\$APPLICATION-\>IncludeComponent\(\s*(\'|")bitrix\:news\.list(\'|")\,\s*(\'|")#SLID2ER#/i';

	protected static function run()
	{
		AssertComponent::componentLocator(Slider::class);
		if ($slider = Slider::find()) {
			Assert::fileLocator(MainHeaderTemplate::class);
			if ($page = MainHeaderTemplate::find()) {
				$regex = str_replace('#SLIDER#', $slider['TEMPLATE_NAME'], static::REG_INCLUDE_SLIDER);
				Assert::fileContentMatches($page, new Regex($regex,
					Loc::getMessage('INTERVOLGA_EDU.COURSE_2.LESSON_1_2.WRONG_PATH_SLIDER')));
			}
		}
	}
}