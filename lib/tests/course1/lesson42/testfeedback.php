<?php
namespace Intervolga\Edu\Tests\Course1\Lesson42;

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
		Assert::eq('/contacts/index.php', $feedback['REAL_PATH']);
	}
}