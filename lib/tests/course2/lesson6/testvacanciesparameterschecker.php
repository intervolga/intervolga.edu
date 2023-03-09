<?php
namespace Intervolga\Edu\Tests\Course2\Lesson6;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Asserts\AssertComponent;
use Intervolga\Edu\Locator\Component\CustomVacancies;
use Intervolga\Edu\Locator\Iblock\Vacancies;
use Intervolga\Edu\Tests\BaseTest;

class TestVacanciesParametersChecker extends BaseTest
{
	public static function interceptErrors()
	{
		return true;
	}

	protected static function run()
	{
		AssertComponent::componentLocator(CustomVacancies::class);
		Assert::iblockLocator(Vacancies::class);
		if ($vacancyIblock = Vacancies::find()) {
			Assert::eq(
				static::prepareUrl($vacancyIblock['LIST_PAGE_URL']),
				'#SITE_DIR#company/vacancies/',
				Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_6_VACANCIES_LIST_PAGE_URL')
			);
			Assert::eq(
				static::prepareUrl($vacancyIblock['DETAIL_PAGE_URL']),
				'#SITE_DIR#company/vacancies/#ELEMENT_ID#/',
				Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_6_VACANCIES_DETAIL_PAGE_URL')
			);
		}

		if ($componentParameters = CustomVacancies::find()['PARAMETERS']) {
			Assert::eq(
				$componentParameters['SEF_MODE'],
				'Y',
				Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_6_EMPTY_SEF_MODE'));

			Assert::notEmpty(
				$componentParameters['SEF_URL_TEMPLATES'],
				Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_6_EMPTY_SEF_URL_TEMPLATES'));

			if ($componentParameters['SEF_URL_TEMPLATES']) {
				Assert::eq(
					static::prepareUrl($componentParameters['SEF_FOLDER']),
					'#SITE_DIR#company/vacancies/',
					Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_6_VACANCIES_SEF_FOLDER')
				);
				Assert::eq(
					static::prepareUrl($componentParameters['SEF_URL_TEMPLATES']['vacancies']),
					'',
					Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_6_VACANCIES_URL')
				);
				Assert::eq(
					static::prepareUrl($componentParameters['SEF_URL_TEMPLATES']['vacancy']),
					'#ELEMENT_ID#/',
					Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_6_VACANCY_URL')
				);
				Assert::eq(
					static::prepareUrl($componentParameters['SEF_URL_TEMPLATES']['resume']),
					'#ELEMENT_ID#/resume',
					Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_6_RESUME_URL')
				);
			}
		}
	}

	protected static function prepareUrl($url)
	{
		if (!empty($url)) {
			str_replace(
				[
					'#SITE_DIR#/',
					'#ID#'
				],
				[
					'#SITE_DIR#',
					'#ELEMENT_ID#'
				],
				$url
			);
		}

		return $url;
	}
}