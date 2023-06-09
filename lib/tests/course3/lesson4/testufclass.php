<?php
namespace Intervolga\Edu\Tests\Course3\Lesson4;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\Event;
use Intervolga\Edu\Locator\Uf\UfLocator;
use Intervolga\Edu\Tests\BaseTest;

class TestUfClass extends BaseTest
{
	public static function interceptErrors()
	{
		return true;
	}

	protected static function run()
	{
		Assert::eventExists(Event\MediaType::class);
		if ($event = Event\MediaType::find()) {
			Assert::userField(new UfLocator([
				'=USER_TYPE_ID' => $event['RESULT']['USER_TYPE_ID'],
				'=MANDATORY' => 'N',
				'=MULTIPLE' => 'N',
				'=ENTITY_ID' => 'USER',
			]));
			Assert::userField(new UfLocator([
				'=USER_TYPE_ID' => $event['RESULT']['USER_TYPE_ID'],
				'=MANDATORY' => 'Y',
				'=MULTIPLE' => 'N',
				'=ENTITY_ID' => 'USER',
			]));
			Assert::userField(new UfLocator([
				'=USER_TYPE_ID' => $event['RESULT']['USER_TYPE_ID'],
				'=MANDATORY' => 'N',
				'=MULTIPLE' => 'Y',
				'=ENTITY_ID' => 'USER',
			]));
			Assert::userField(new UfLocator([
				'=USER_TYPE_ID' => $event['RESULT']['USER_TYPE_ID'],
				'=MANDATORY' => 'Y',
				'=MULTIPLE' => 'Y',
				'=ENTITY_ID' => 'USER',
			]));
		}
	}
}
