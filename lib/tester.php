<?php
namespace Intervolga\Edu;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Exceptions\AssertException;
use Intervolga\Edu\Tests\BaseTest;
use Bitrix\Main\Localization\Loc;

class Tester
{
	/**
	 * @var AssertException[]
	 */
	protected static $exceptions = [];
	protected static $locatorsFound = [];

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
			\Intervolga\Edu\Tests\Course1\Lesson2\TestCheckPartnersSection::class,
			\Intervolga\Edu\Tests\Course1\Lesson2\TestPartnersPage::class,
			\Intervolga\Edu\Tests\Course1\Lesson2\TestSeoPartners::class,
			\Intervolga\Edu\Tests\Course1\Lesson2\TestMenu::class,
			\Intervolga\Edu\Tests\Course1\Lesson2\TestLocalPhpInterface::class,
			\Intervolga\Edu\Tests\Course1\Lesson2\TestDumpFunction::class,
			\Intervolga\Edu\Tests\Course1\Lesson2\TestLowerCase::class,
			\Intervolga\Edu\Tests\Course1\Lesson2\TestCode::class,

			\Intervolga\Edu\Tests\Course1\Lesson3\TestTemplates::class,
			\Intervolga\Edu\Tests\Course1\Lesson3\TestTemplateConditions::class,
			\Intervolga\Edu\Tests\Course1\Lesson3\TestCode::class,
			\Intervolga\Edu\Tests\Course1\Lesson3\TestOption::class,
			\Intervolga\Edu\Tests\Course1\Lesson3\TestLang::class,
			\Intervolga\Edu\Tests\Course1\Lesson3\TestScripts::class,

			\Intervolga\Edu\Tests\Course1\Lesson41\TestIncludeArea::class,
			\Intervolga\Edu\Tests\Course1\Lesson41\TestTopMenu::class,
			\Intervolga\Edu\Tests\Course1\Lesson41\TestLeftMenu::class,
			\Intervolga\Edu\Tests\Course1\Lesson41\TestBottomMenu::class,
			\Intervolga\Edu\Tests\Course1\Lesson41\TestAboutMenuItems::class,
			\Intervolga\Edu\Tests\Course1\Lesson41\TestBreadcrumb::class,

			\Intervolga\Edu\Tests\Course1\Lesson42\TestRegisterPageOption::class,
			\Intervolga\Edu\Tests\Course1\Lesson42\TestEmail::class,
			\Intervolga\Edu\Tests\Course1\Lesson42\TestAuthorize::class,
			\Intervolga\Edu\Tests\Course1\Lesson42\TestFeedback::class,

			\Intervolga\Edu\Tests\Course1\Lesson6\TestReviewsIblock::class,
			\Intervolga\Edu\Tests\Course1\Lesson6\TestPromoIblock::class,
			\Intervolga\Edu\Tests\Course1\Lesson6\TestReviewsCarousel::class,
			\Intervolga\Edu\Tests\Course1\Lesson6\TestReviewsRand::class,
			\Intervolga\Edu\Tests\Course1\Lesson6\TestLastPromo::class,
			\Intervolga\Edu\Tests\Course1\Lesson6\TestReviewsList::class,

			\Intervolga\Edu\Tests\Course1\Lesson7\TestLatestStock::class,
			\Intervolga\Edu\Tests\Course1\Lesson7\TestMenu::class,
			\Intervolga\Edu\Tests\Course1\Lesson7\TestReviewList::class,
			\Intervolga\Edu\Tests\Course1\Lesson7\TestReviewCarousel::class,
			\Intervolga\Edu\Tests\Course1\Lesson7\TestRandomReview::class,

			\Intervolga\Edu\Tests\Course1\Lesson8\TestPromoComponent::class,

			\Intervolga\Edu\Tests\Course1\Lesson9\TestCatalogIblock::class,
			\Intervolga\Edu\Tests\Course1\Lesson9\TestComponentOptions::class,
			\Intervolga\Edu\Tests\Course1\Lesson9\TestSymbolicCode::class,
			\Intervolga\Edu\Tests\Course1\Lesson9\TestNavPage::class,

			\Intervolga\Edu\Tests\Course1\Lesson10\TestSearchAction::class,
			\Intervolga\Edu\Tests\Course1\Lesson10\TestSearchTemplate::class,

			\Intervolga\Edu\Tests\Course1\Lesson11\TestCatalogRating::class,
			\Intervolga\Edu\Tests\Course1\Lesson11\TestCheckSetViewTarget::class,
			\Intervolga\Edu\Tests\Course1\Lesson11\TestCheckShowContent::class,
			\Intervolga\Edu\Tests\Course1\Lesson11\TestPropertyIsExist::class,
			\Intervolga\Edu\Tests\Course1\Lesson11\TestSmartFilterIsExist::class,
			\Intervolga\Edu\Tests\Course1\Lesson11\TestPropertyInFilter::class,

			\Intervolga\Edu\Tests\Course2\Lesson1_2\TestComponentInclude::class,
			\Intervolga\Edu\Tests\Course2\Lesson1_2\TestSlider::class,
			\Intervolga\Edu\Tests\Course2\Lesson1_2\TestSliderTestCode::class,
			\Intervolga\Edu\Tests\Course2\Lesson1_2\TestSliderComponent::class,
			\Intervolga\Edu\Tests\Course2\Lesson1_2\TestSliderCodeAnalysis::class,

			\Intervolga\Edu\Tests\Course2\Lesson1_2\TestCatalogBindingProperty::class,
			\Intervolga\Edu\Tests\Course2\Lesson1_2\TestPropertyPrice::class,

			\Intervolga\Edu\Tests\Course2\Lesson2\TestAgentExist::class,
			\Intervolga\Edu\Tests\Course2\Lesson2\TestAgentParameters::class,
			\Intervolga\Edu\Tests\Course2\Lesson2\TestPostEvent::class,

			\Intervolga\Edu\Tests\Course2\Lesson3\TestHandlersChecker::class,
			\Intervolga\Edu\Tests\Course2\Lesson3\TestDeactivationActiveNews::class,
			\Intervolga\Edu\Tests\Course2\Lesson3\TestDeactivationNotActiveNews::class,

			\Intervolga\Edu\Tests\Course2\Lesson4\TestSetViewTargetNews::class,
			\Intervolga\Edu\Tests\Course2\Lesson4\TestShowViewTargetNews::class,
			\Intervolga\Edu\Tests\Course2\Lesson4\TestSetViewTargetMaterials::class,
			\Intervolga\Edu\Tests\Course2\Lesson4\TestShowViewContentMaterials::class,

			\Intervolga\Edu\Tests\Course2\Lesson5_1\TestComponentDirectory::class,
			\Intervolga\Edu\Tests\Course2\Lesson5_1\TestDescription::class,
			\Intervolga\Edu\Tests\Course2\Lesson5_1\TestHermitage::class,

			\Intervolga\Edu\Tests\Course2\Lesson5_2\TestComponentCache::class,

			\Intervolga\Edu\Tests\Course2\Lesson6\TestWebFormsChecker::class,
			\Intervolga\Edu\Tests\Course2\Lesson6\TestVacanciesParametersChecker::class,
			\Intervolga\Edu\Tests\Course2\Lesson6\TestCustomComponentChecker::class,

			\Intervolga\Edu\Tests\Course2\Lesson7\TestAccessPartners::class,
			\Intervolga\Edu\Tests\Course2\Lesson7\TestPartnersUser::class,
			\Intervolga\Edu\Tests\Course2\Lesson7\TestSecurityLevel::class,
			\Intervolga\Edu\Tests\Course2\Lesson7\TestSecureAuthorization::class,

			\Intervolga\Edu\Tests\Course2\Lesson7\TestLiteadminAccessChecker::class,
			\Intervolga\Edu\Tests\Course2\Lesson7\TestSubscriptionGroupChecker::class,
			\Intervolga\Edu\Tests\Course2\Lesson7\TestProfileGroupEditCheker::class,

			\Intervolga\Edu\Tests\Course2\Lesson8\TestGadgetTemplate::class,
			\Intervolga\Edu\Tests\Course2\Lesson8\TestSettingResultLinks::class,
			\Intervolga\Edu\Tests\Course2\Lesson8\TestDesktopPage::class,

			\Intervolga\Edu\Tests\Course2\Lesson9\TestWizardTemplate::class,
			\Intervolga\Edu\Tests\Course2\Lesson9\TestWizard::class,

			\Intervolga\Edu\Tests\Course3\Lesson1\TestModule::class,

			\Intervolga\Edu\Tests\Course3\Lesson2\TestAdminPages::class,
			\Intervolga\Edu\Tests\Course3\Lesson2\TestCustomModule::class,
			\Intervolga\Edu\Tests\Course3\Lesson2\TestClasses::class,
			\Intervolga\Edu\Tests\Course3\Lesson2\TestContentPage::class,

			\Intervolga\Edu\Tests\Course3\Lesson3\TestResultsPollingIblock::class,
			\Intervolga\Edu\Tests\Course3\Lesson3\TestPropertyGenderValues::class,
			\Intervolga\Edu\Tests\Course3\Lesson3\TestLinkWithRespondent::class,
            \Intervolga\Edu\Tests\Course3\Lesson3\TestPropertyCode::class,
			\Intervolga\Edu\Tests\Course3\Lesson3\TestRespondentComponent::class,
			\Intervolga\Edu\Tests\Course3\Lesson3\TestRespondentComponentTemplate::class,
			\Intervolga\Edu\Tests\Course3\Lesson3\TestSubQuery::class,

			\Intervolga\Edu\Tests\Course3\Lesson4\TestUf::class,
			\Intervolga\Edu\Tests\Course3\Lesson4\TestUfClass::class,
			\Intervolga\Edu\Tests\Course3\Lesson4\TestUFClassIblock::class,

			\Intervolga\Edu\Tests\Course3\Lesson5\TestGalleryIblock::class,
			\Intervolga\Edu\Tests\Course3\Lesson5\TestGalleryElements::class,
			\Intervolga\Edu\Tests\Course3\Lesson5\TestTemplateGallery::class,
			\Intervolga\Edu\Tests\Course3\Lesson5\TestComponentGallery::class,

			\Intervolga\Edu\Tests\Course3\Lesson6\TestCacheComponentCheker::class,
			\Intervolga\Edu\Tests\Course3\Lesson6\TestTaggedCacheChecker::class,
			\Intervolga\Edu\Tests\Course3\Lesson6\TestCacheTesting::class,

			\Intervolga\Edu\Tests\Course3\Lesson7\TestIblockFullness::class,
			\Intervolga\Edu\Tests\Course3\Lesson7\TestPerformancePage::class,

			\Intervolga\Edu\Tests\Course3\Lesson8\TestAcceptedTests::class,
			\Intervolga\Edu\Tests\Course3\Lesson8\TestThisSiteSupport::class,
			\Intervolga\Edu\Tests\Course3\Lesson8\TestUserTestExists::class,

			\Intervolga\Edu\Tests\Course3\Lesson9\TestCompositeEnabled::class,

			\Intervolga\Edu\Tests\CourseIntervolga\Lesson1\TestRobotsChecker::class,
			\Intervolga\Edu\Tests\CourseIntervolga\Lesson2\TestModulesCheck::class,

			\Intervolga\Edu\Tests\CourseIntervolga\Lesson3\BackupCheker::class,
		];
	}

	public static function getTestClassesCount(): int
	{
		return count(static::getTestClasses());
	}

	public static function run()
	{
		/**
		 * @var BaseTest $testClass
		 */
		foreach (static::getTestClasses() as $testClass) {
			try {
				Assert::resetLocatorsFound();
				$testClass::runOuter();
			} catch (AssertException $assertException) {
				static::$exceptions[$testClass] = $assertException;
			} catch (\Throwable $throwable) {
				static::$exceptions[$testClass] = AssertException::createThrowable($throwable);
			}
			static::$locatorsFound[$testClass] = Assert::getLocatorsFound();

			$tmpArray = explode('\\', str_replace('Intervolga\\Edu\\Tests\\', '', $testClass));
			if (stripos($tmpArray[2], 'test') !== 0) {
				static::$exceptions[$testClass] =
					new AssertException(Loc::getMessage('INTERVOLGA_EDU.NAME_TEST_NOT_MATCH_REQUIREMENTS',
						['#TEST_NAME#' => $tmpArray[2]]));
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

	/**
	 * @return array
	 */
	public static function getLocatorsFound()
	{
		return static::$locatorsFound;
	}
}
