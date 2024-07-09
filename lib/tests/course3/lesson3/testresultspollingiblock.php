<?php
namespace Intervolga\Edu\Tests\Course3\Lesson3;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\Iblock\Property\AgePollResultProperty;
use Intervolga\Edu\Locator\Iblock\Property\ConnectRespondentProperty;
use Intervolga\Edu\Locator\Iblock\Property\GenderProperty;
use Intervolga\Edu\Locator\Iblock\Property\SalaryProperty;
use Intervolga\Edu\Locator\Iblock\ResultsPollingIblock;
use Intervolga\Edu\Tests\BaseTestIblock;

class TestResultsPollingIblock extends BaseTestIblock
{
	protected static function run()
	{
		parent::run();
		static::checkSettings();
	}

	protected static function checkSettings()
	{
		Assert::empty(static::getLocator()::find()['LIST_PAGE_URL'],
			Loc::getMessage('INTERVOLGA_EDU.COURSE_3_LESSON_3_SETTINGS_NOT_EMPTY_LIST_PAGE_URL'));
		Assert::empty(static::getLocator()::find()['DETAIL_PAGE_URL'],
			Loc::getMessage('INTERVOLGA_EDU.COURSE_3_LESSON_3_SETTINGS_NOT_EMPTY_DETAIL_PAGE_URL'));
		Assert::empty(static::getLocator()::find()['SECTION_PAGE_URL'],
			Loc::getMessage('INTERVOLGA_EDU.COURSE_3_LESSON_3_SETTINGS_NOT_EMPTY_SECTION_PAGE_URL'));

		Assert::eq(static::getLocator()::find()['INDEX_ELEMENT'], 'N',
			Loc::getMessage('INTERVOLGA_EDU.COURSE_3_LESSON_3_SETTINGS_NOT_EMPTY_INDEX_ELEMENT'));
		Assert::eq(static::getLocator()::find()['INDEX_SECTION'], 'N',
			Loc::getMessage('INTERVOLGA_EDU.COURSE_3_LESSON_3_SETTINGS_NOT_EMPTY_INDEX_SECTION'));
	}

	protected static function getLocator()
	{
		return ResultsPollingIblock::class;
	}

	protected static function getMinCount(): int
	{
		return 1;
	}

	protected static function getPropertiesLocators(): array
	{
		return [
			SalaryProperty::class,
			ConnectRespondentProperty::class,
			GenderProperty::class,
			AgePollResultProperty::class
		];
	}

	protected static function testElementsLog(array $iblock)
	{}
}