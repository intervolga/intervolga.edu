<?php
namespace Intervolga\Edu;

use Intervolga\Edu\Tests\Course1\TestLesson2;
use Intervolga\Edu\Tests\CourseOne\LessonOne\TestEdition;
use Intervolga\Edu\Tests\CourseOne\LessonOne\TestSiteChecker;
use Intervolga\Edu\Tests\CourseOne\LessonOne\TestSiteCorporate;
use Intervolga\Edu\Tests\CourseOne\LessonOne\TestUpdates;

class Tester
{
	protected static function getTestClasses()
	{
		return [
			TestEdition::class,
			TestSiteCorporate::class,
			TestUpdates::class,
			TestSiteChecker::class,
			TestLesson2::class,
		];
	}

	public static function run()
	{
		/**
		 * @var \Intervolga\Edu\Tests\BaseTest $testClass
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
		 * @var \Intervolga\Edu\Tests\BaseTest $testClass
		 */
		foreach (static::getTestClasses() as $testClass) {
			$errors[$testClass] = $testClass::getErrors();
		}

		return $errors;
	}
}
