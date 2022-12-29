<?php
namespace Intervolga\Edu\Tests\Course1\Lesson2;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;

class TestDumpFunction extends BaseTest
{
	protected static function run()
	{
		$dump = static::findCustomDump();
		Assert::notEmpty($dump, Loc::getMessage('INTERVOLGA_EDU.NOT_FOUND_DUMP',
			[
				'#POSSIBLE#' => implode(' || ',  static::getPossibleName())
			]
		));
		Assert::functionExists($dump);
	}

	protected static function findCustomDump()
	{
		$names = static::getPossibleName();
		foreach ($names as $name) {
			if (function_exists($name)) {
				return $name;
			}
		}

		return false;
	}

	protected static function getPossibleName()
	{
		return [
			'test_dump',
			'dump',
			'dump_test'
		];
	}

	protected static function getPossibleTips()
	{
		return implode('||',  static::getPossibleName());
	}
}