<?php
namespace Intervolga\Edu\Tests\Course3\Lesson4;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Locator\Event;
use Intervolga\Edu\Util\Regex;

class TestUFClassIblock extends BaseTest
{
	protected static function run()
	{
		$event = Event\MediaType::find();
		$regex = new Regex('/IBLOCK_[^0-9]_SECTION/', 'IBLOCK_0_SECTION');
		Assert::userFieldExistsByRegex($event, $regex);
	}
}
