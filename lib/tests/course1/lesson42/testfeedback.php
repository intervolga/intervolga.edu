<?php
namespace Intervolga\Edu\Tests\Course1\Lesson42;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Asserts\AssertComponent;
use Intervolga\Edu\Locator\Component\Feedback;
use Intervolga\Edu\Tests\BaseTest;

class TestFeedback extends BaseTest
{
	protected static function run()
	{
		AssertComponent::componentLocator(Feedback::class);
		$feedback = Feedback::find();
		Assert::eq(
			$feedback['REAL_PATH'],
			'/contacts/index.php',
			Loc::getMessage('INTERVOLGA_EDU.FEEDBACK_NOT_FOUND_AT_PAGE')
		);
	}
}