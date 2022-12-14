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

		foreach ($rules as $rule) {
			Assert::userFieldExistsByString(Event\MediaType::class, $rule, 'USER');
		}
		// $regex = new Regex('/IBLOCK_[^0-9]_SECTION/', "IBLOCK_0_SECTION");
		//Assert::userFieldExistsByRegex(Event\MediaType::class, [], );
	}
}
