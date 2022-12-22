<?php
namespace Intervolga\Edu;

use Intervolga\Edu\Exceptions\AssertException;
use Intervolga\Edu\Tests\BaseTest;

class Tester
{
	/**
	 * @var AssertException[]
	 */
	protected static $exceptions = [];

	/**
	 * @return string[]|BaseTest[]
	 */
	protected static function getTestClasses()
	{
		return [
			\Intervolga\Edu\Tests\Course1\Lesson1\TestLicense::class,
			\Intervolga\Edu\Tests\Course1\Lesson1\TestUpdates::class,
			\Intervolga\Edu\Tests\Course1\Lesson1\TestSiteCorporateModule::class,
			\Intervolga\Edu\Tests\Course1\Lesson1\TestSiteCorporateIblocks::class,
			\Intervolga\Edu\Tests\Course1\Lesson1\TestSiteCorporateSections::class,
			\Intervolga\Edu\Tests\Course1\Lesson1\TestSiteChecker::class,

			\Intervolga\Edu\Tests\Course1\Lesson2\TestServicesDeleted::class,
			\Intervolga\Edu\Tests\Course1\Lesson2\TestReviews::class,
			\Intervolga\Edu\Tests\Course1\Lesson2\TestProducts::class,
			\Intervolga\Edu\Tests\Course1\Lesson2\TestPromo::class,
			\Intervolga\Edu\Tests\Course1\Lesson2\TestPartnersPage::class,
			\Intervolga\Edu\Tests\Course1\Lesson2\TestMenu::class,
			\Intervolga\Edu\Tests\Course1\Lesson2\TestLocalPhpInterface::class,
			\Intervolga\Edu\Tests\Course1\Lesson2\TestDumpFunction::class,
			\Intervolga\Edu\Tests\Course1\Lesson2\TestLowerCase::class,
			\Intervolga\Edu\Tests\Course1\Lesson2\TestCode::class,

			\Intervolga\Edu\Tests\Course1\Lesson3\TestTemplates::class,
			\Intervolga\Edu\Tests\Course1\Lesson3\TestCode::class,
			\Intervolga\Edu\Tests\Course1\Lesson3\TestScripts::class,

			\Intervolga\Edu\Tests\Course1\Lesson41\TestIncludeArea::class,
			\Intervolga\Edu\Tests\Course1\Lesson41\TestTopMenu::class,
			\Intervolga\Edu\Tests\Course1\Lesson41\TestLeftMenu::class,
			\Intervolga\Edu\Tests\Course1\Lesson41\TestBottomMenu::class,
			\Intervolga\Edu\Tests\Course1\Lesson41\TestBreadcrumb::class,

			\Intervolga\Edu\Tests\Course1\Lesson42\TestRegisterPageOption::class,
			\Intervolga\Edu\Tests\Course1\Lesson42\TestEmail::class,
			\Intervolga\Edu\Tests\Course1\Lesson42\TestAuthorize::class,

			\Intervolga\Edu\Tests\Course1\Lesson6\TestReviewsIblock::class,
			\Intervolga\Edu\Tests\Course1\Lesson6\TestPromoIblock::class,
			\Intervolga\Edu\Tests\Course1\Lesson6\TestReviewsCarousel::class,
			\Intervolga\Edu\Tests\Course1\Lesson6\TestReviewsRand::class,
			\Intervolga\Edu\Tests\Course1\Lesson6\TestLastPromo::class,
			\Intervolga\Edu\Tests\Course1\Lesson6\TestReviewsList::class,

			\Intervolga\Edu\Tests\Course1\Lesson8\TestPromoComponent::class,

			\Intervolga\Edu\Tests\Course1\Lesson10\TestSearchAction::class,
			\Intervolga\Edu\Tests\Course1\Lesson10\TestSearchTemplate::class,

			\Intervolga\Edu\Tests\Course1\Lesson11\TestCatalogRating::class,
			\Intervolga\Edu\Tests\Course1\Lesson11\TestCheckSetViewTarget::class,
			\Intervolga\Edu\Tests\Course1\Lesson11\TestCheckShowContent::class,

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
			try {
				$testClass::runOuter();
			} catch (AssertException $assertException) {
				static::$exceptions[$testClass] = $assertException;
			}
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
			$errors[$testClass::getCourseCode()][$testClass::getLessonCode()][$testClass] = [];
			if ($exception = static::$exceptions[$testClass]) {
				if ($exception->getExceptions()) {
					foreach ($exception->getExceptions() as $innerException) {
						$errors[$testClass::getCourseCode()][$testClass::getLessonCode()][$testClass][] = $innerException->getMessage();
					}
				} else {
					$errors[$testClass::getCourseCode()][$testClass::getLessonCode()][$testClass][] = $exception->getMessage();
				}
			}
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
			$path = explode('\\', $testClass);
			$code = array_pop($path);

			$tree[$testClass::getCourseCode()]['TITLE'] = $testClass::getCourseLoc();
			$tree[$testClass::getCourseCode()]['COUNT']++;
			$tree[$testClass::getCourseCode()]['LESSONS'][$testClass::getLessonCode()]['TITLE'] = $testClass::getLessonLoc();
			$tree[$testClass::getCourseCode()]['LESSONS'][$testClass::getLessonCode()]['COUNT']++;
			$tree[$testClass::getCourseCode()]['LESSONS'][$testClass::getLessonCode()]['TESTS'][$testClass]['CODE'] = $code;
			$tree[$testClass::getCourseCode()]['LESSONS'][$testClass::getLessonCode()]['TESTS'][$testClass]['TITLE'] = $testClass::getTestLoc();
			$tree[$testClass::getCourseCode()]['LESSONS'][$testClass::getLessonCode()]['TESTS'][$testClass]['DESCRIPTION'] = $testClass::getDescription();
		}

		return $tree;
	}
}
