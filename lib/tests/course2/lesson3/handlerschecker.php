<?php
namespace Intervolga\Edu\Tests\Course2\Lesson3;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\Event\OnBeforeIblockElementUpdateLocator;
use Intervolga\Edu\Tests\BaseTest;

class HandlersChecker extends BaseTest
{
	protected static function run()
	{
		Assert::eventExists(OnBeforeIblockElementUpdateLocator::class);
	}
}