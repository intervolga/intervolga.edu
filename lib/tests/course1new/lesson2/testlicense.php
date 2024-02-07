<?php
namespace Intervolga\Edu\Tests\Course1New\Lesson2;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\UpdateSystem;

class TestLicense extends BaseTest
{
	const STANDART_LICENSE = 'Стандарт';

	protected static function run()
	{
		$status = UpdateSystem::getStatus();
		Assert::eq(
			$status['LICENSE'],
			static::STANDART_LICENSE
		);
	}
}