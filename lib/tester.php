<?php
namespace Intervolga\Edu;

use Intervolga\Edu\Tests\BaseTest;

class Tester
{
	/**
	 * @return string[]|BaseTest[]
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
			\Intervolga\Edu\Tests\Course1\Lesson2\TestProducts::class,
			\Intervolga\Edu\Tests\Course1\Lesson2\TestPromo::class,
			\Intervolga\Edu\Tests\Course1\Lesson2\TestPartners::class,
			\Intervolga\Edu\Tests\Course1\Lesson2\TestPartnersPage::class,
			\Intervolga\Edu\Tests\Course1\Lesson2\TestMenu::class,
			\Intervolga\Edu\Tests\Course1\Lesson2\TestLocalPhpInterface::class,
			\Intervolga\Edu\Tests\Course1\Lesson2\TestDumpFunction::class,
			\Intervolga\Edu\Tests\Course1\Lesson2\TestLowerCase::class,

			\Intervolga\Edu\Tests\Course1\Lesson3\TestTemplates::class,
			\Intervolga\Edu\Tests\Course1\Lesson3\TestCustomCoreCheck::class,
			\Intervolga\Edu\Tests\Course1\Lesson3\TestLongPhpTag::class,
			\Intervolga\Edu\Tests\Course1\Lesson3\TestScripts::class,
			\Intervolga\Edu\Tests\Course1\Lesson3\TestCoreD7::class,

			\Intervolga\Edu\Tests\Course1\Lesson41\TestImages::class,
			\Intervolga\Edu\Tests\Course1\Lesson41\TestUglyCheckResult::class,
			\Intervolga\Edu\Tests\Course1\Lesson41\TestIncludeArea::class,

			\Intervolga\Edu\Tests\Course1\Lesson42\TestRegisterPageOption::class,
			\Intervolga\Edu\Tests\Course1\Lesson42\TestEmail::class,

			\Intervolga\Edu\Tests\Course1\Lesson6\TestReviewsIblock::class,
			\Intervolga\Edu\Tests\Course1\Lesson6\TestPromoIblock::class,
			\Intervolga\Edu\Tests\Course1\Lesson6\TestReviewsCarousel::class,
			\Intervolga\Edu\Tests\Course1\Lesson6\TestReviewsRand::class,
			\Intervolga\Edu\Tests\Course1\Lesson6\TestLastPromo::class,
			\Intervolga\Edu\Tests\Course1\Lesson6\TestReviewsList::class,

			\Intervolga\Edu\Tests\Course1\Lesson10\TestSearchAction::class,

			\Intervolga\Edu\Tests\Course3\Lesson1\TestModule::class,
			\Intervolga\Edu\Tests\Course3\Lesson4\TestUf::class,
		];
	}

	public static function run()
	{
		/**
		 * @var BaseTest $testClass
		 */
		foreach (static::getTestClasses() as $testClass) {
			$testClass::runSafe();
		}
	}

	/**
	 * @return string[][][]
	 */
	public static function getErrorsTree()
	{
		$errors = [];
		/**
		 * @var BaseTest $testClass
		 */
		foreach (static::getTestClasses() as $testClass) {
			$errors[$testClass::getCourseCode()][$testClass::getLessonCode()][$testClass] = $testClass::getErrors();
		}

		return $errors;
	}

	/**
	 * @return array|BaseTest[]
	 */
	public static function getTestsTree()
	{
		$tree = [];
		$classes = static::getTestClasses();
		foreach ($classes as $testClass) {
			$tree[$testClass::getCourseCode()]['TITLE'] = $testClass::getCourseLoc();
			$tree[$testClass::getCourseCode()]['COUNT']++;
			$tree[$testClass::getCourseCode()]['LESSONS'][$testClass::getLessonCode()]['TITLE'] = $testClass::getLessonLoc();
			$tree[$testClass::getCourseCode()]['LESSONS'][$testClass::getLessonCode()]['COUNT']++;
			$tree[$testClass::getCourseCode()]['LESSONS'][$testClass::getLessonCode()]['TESTS'][$testClass] = $testClass::getTestLoc();
		}

		return $tree;
	}
}
