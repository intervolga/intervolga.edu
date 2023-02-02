<?php
namespace Intervolga\Edu\Tests\Course2\Lesson3;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\Event\OnAfterUserUpdateLocator;
use Intervolga\Edu\Locator\Event\OnBeforeIblockElementDeleteLocator;
use Intervolga\Edu\Locator\Event\OnBeforeIblockElementUpdateLocator;
use Intervolga\Edu\Locator\Event\OnBeforeUserUpdateLocator;
use Intervolga\Edu\Tests\BaseTest;

class TestHandlersChecker extends BaseTest
{
	public static function interceptErrors()
	{
		return true;
	}

	protected static function run()
	{
		Assert::eventExists(OnBeforeIblockElementUpdateLocator::class);
		Assert::eventExists(OnBeforeIblockElementDeleteLocator::class);
		Assert::eventExists(OnBeforeUserUpdateLocator::class);
		Assert::eventExists(OnAfterUserUpdateLocator::class);
	}
}