<?php
namespace Intervolga\Edu\Tests\Course3\Lesson7;

use Intervolga\Edu\Asserts\AssertComponent;
use Intervolga\Edu\Locator\Component\PerfElementList;
use Intervolga\Edu\Tests\BaseTest;

class TestPerformancePage extends BaseTest
{
	protected static function run()
	{
		AssertComponent::componentLocator(PerfElementList::class);
	}
}