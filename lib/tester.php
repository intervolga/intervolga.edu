<?php
namespace Intervolga\Edu;

use Intervolga\Edu\Tests\Course1\TestLesson1;
use Intervolga\Edu\Tests\Course1\TestLesson2;
use Intervolga\Edu\Tests\Course1\TestLesson3;
use Intervolga\Edu\Tests\Course1\TestLesson41;

class Tester
{
	protected static function getTestClasses()
	{
		return [
			TestLesson1::class,
			TestLesson2::class,
			TestLesson3::class,
			TestLesson41::class,
		];
	}

	public static function run()
	{
		/**
		 * @var \Intervolga\Edu\Util\BaseTest $testClass
		 */
		foreach (static::getTestClasses() as $testClass) {
			$testClass::run();
		}
	}

	/**
	 * @return string[]
	 */
	public static function getErrorsTree()
	{
		$errors = [];
		/**
		 * @var \Intervolga\Edu\Util\BaseTest $testClass
		 */
		foreach (static::getTestClasses() as $testClass) {
			$errors[$testClass] = $testClass::getErrors();
		}

		return $errors;
	}

	public static function getTestsTree()
	{
		echo '<pre>' . __FILE__ . ':' . __LINE__ . ':<br>' . print_r(__DIR__, true) . '</pre>';
	}
}
