<?php
namespace Intervolga\Edu\Tests\Course3\Lesson4;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Locator\Event;
use Intervolga\Edu\Util\Regex;

class TestUfClass extends BaseTest
{
	protected static function run()
	{
		$rules = [
			[
				'MANDATORY' => 'N',
				'MULTIPLE' => 'N'
			],
			[
				'MANDATORY' => 'N',
				'MULTIPLE' => 'Y'
			],
			[
				'MANDATORY' => 'Y',
				'MULTIPLE' => 'N'
			],
			[
				'MANDATORY' => 'Y',
				'MULTIPLE' => 'Y'
			],
		];
		$event = Event\MediaType::find();

		foreach ($rules as $rule) {
			Assert::userFieldExistsByString($event, $rule, 'USER');
		}
	}
}
