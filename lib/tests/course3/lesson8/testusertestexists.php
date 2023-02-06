<?php
namespace Intervolga\Edu\Tests\Course3\Lesson8;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Locator\Event\OnCheckListGetLocator;

class TestUserTestExists extends BaseTest
{
	protected static function run()
	{
		Assert::eventExists(OnCheckListGetLocator::class);
		$event = OnCheckListGetLocator::find();

		$checklist = new \CCheckList();
		$eventAnswer = $event['TO_NAME']([]);
		$category = array_keys($eventAnswer['CATEGORIES'])[0];
		$customCategory = $checklist->GetPoints($category);

		foreach ($customCategory as $point) {
			Assert::eq($point['STATE']['STATUS'], 'A', Loc::getMessage('INTERVOLGA_EDU.WAS_NOT_MADE', [
				'#NAME#' => $point['NAME']
			]));
		}
	}
}