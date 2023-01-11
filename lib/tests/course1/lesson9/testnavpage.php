<?php
namespace Intervolga\Edu\Tests\Course1\Lesson9;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\Component\Catalog;
use Intervolga\Edu\Tests\BaseTest;

class TestNavPage extends BaseTest
{
	protected static function run()
	{
		$parameters = Catalog::find()['PARAMETERS'];

		Assert::eq($parameters['PAGE_ELEMENT_COUNT'], 5, Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_1_9_PAGE_ELEMENT_COUNT'));
		Assert::eq($parameters['PAGER_TEMPLATE'], 'arrows', Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_1_9_PAGER_TEMPLATE'));
		if ($parameters['DISPLAY_TOP_PAGER'] != 'Y') {
			Assert::eq($parameters['DISPLAY_BOTTOM_PAGER'], 'Y', Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_1_9_DISPLAY_PAGER'));
		}

	}
}