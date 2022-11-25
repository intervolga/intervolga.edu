<?php
namespace Intervolga\Edu;

class Tester
{
	/**
	 * @return string[]|\Intervolga\Edu\Util\BaseTest[]
	 */
	protected static function getTestClasses()
	{
		return [
			\Intervolga\Edu\Tests\Course1\Lesson1\TestLicense::class,
			\Intervolga\Edu\Tests\Course1\Lesson1\TestUpdates::class,
			\Intervolga\Edu\Tests\Course1\Lesson1\TestSiteCorporate::class,
			\Intervolga\Edu\Tests\Course1\Lesson1\TestSiteChecker::class,
			\Intervolga\Edu\Tests\Course1\Lesson2\TestServicesDeleted::class,
			\Intervolga\Edu\Tests\Course1\Lesson2\TestReviews::class,
			\Intervolga\Edu\Tests\Course1\Lesson2\TestLowerCase::class,
			\Intervolga\Edu\Tests\Course1\Lesson2\TestPartners::class,
			\Intervolga\Edu\Tests\Course1\Lesson2\TestPartnersPage::class,
			\Intervolga\Edu\Tests\Course1\Lesson2\TestMenu::class,
			\Intervolga\Edu\Tests\Course1\Lesson2\TestLocalPhpInterface::class,
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
			$errors[$testClass::getCourseCode()][$testClass::getLessonCode()][$testClass] = $testClass::getErrors();
		}

		return $errors;
	}

	/**
	 * @return array|\Intervolga\Edu\Util\BaseTest[]
	 */
	public static function getTestsTree()
	{
		$tree = [];
		$classes = static::getTestClasses();
		foreach ($classes as $testClass) {
			$tree[$testClass::getCourseCode()]['TITLE'] = $testClass::getCourseLoc();
			$tree[$testClass::getCourseCode()]['LESSONS'][$testClass::getLessonCode()]['TITLE'] = $testClass::getLessonLoc();
			$tree[$testClass::getCourseCode()]['LESSONS'][$testClass::getLessonCode()]['TESTS'][$testClass] = $testClass::getTestLoc();
		}

		return $tree;
	}
}
