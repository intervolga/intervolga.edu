<?php
namespace Intervolga\Edu\Tests\Course2\Lesson5_2;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\Iblock\VacancyIblock;
use Intervolga\Edu\Locator\Iblock\Property\ExperienceProperty;
use Intervolga\Edu\Locator\Iblock\Property\EducationProperty;
use Intervolga\Edu\Locator\Iblock\Property\WorkTimeProperty;

use Intervolga\Edu\Tests\BaseTestIblock;

class TestVacancyIblock extends BaseTestIblock
{
	const MIN_COUNT_ELEMENT_IN_SECTION = 3;
	const MIN_COUNT_SECTION = 2;

	protected static function getLocator()
	{
		return VacancyIblock::class;
	}

	protected static function getPropertiesLocators(): array
	{
		return [
			ExperienceProperty::class,
			EducationProperty::class,
			WorkTimeProperty::class
		];
	}

	protected static function getMinCount(): int
	{
		return 2;
	}

	protected static function run()
	{
		parent::run();
		$id = static::getLocator()::find()['ID'];
		Assert::checkMinCountSection($id, static::MIN_COUNT_SECTION);
		Assert::checkMinElementsInSection($id, static::MIN_COUNT_ELEMENT_IN_SECTION);
		Assert::checkCertainProperties(static::getPropertiesLocators(), $id);

		$changeTo = [
			'name' => 'INTERVOLGA_EDU.CHANGE_TO_NAME',
			'desc' => 'INTERVOLGA_EDU.CHANGE_TO_DESC'
		];
		Assert::checkUnnecessaryProperties($id, $changeTo);

	}

}