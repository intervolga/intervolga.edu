<?php
namespace Intervolga\Edu\Tests\Course2\Lesson9;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\Wizard\Calculator;
use Intervolga\Edu\Tests\BaseTest;

class WizardChecker extends BaseTest
{
	protected static function run()
	{
		Assert::WizardLocator(Calculator::class);
	}
}