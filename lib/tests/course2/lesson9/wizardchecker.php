<?php
namespace Intervolga\Edu\Tests\Course2\Lesson9;

use Bitrix\Main\Localization\Loc;
use CEventLog;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\Wizard\Calculator;
use Intervolga\Edu\Tests\BaseTest;

class WizardChecker extends BaseTest
{
	protected static function run()
	{
		Assert::WizardLocator(Calculator::class);

		$eventList = CEventLog::GetList(false,
			[
				'SEVERITY' => 'INFO',
				'AUDIT_TYPE_ID' => 'intervolga:calculator'
			]
		)->Fetch();
		Assert::notEmpty($eventList, Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_9_MASTER_EVENT_LOG_NOT_FOUND'));
	}
}