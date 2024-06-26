<?php
namespace Intervolga\Edu\Tests\Course3\Lesson3;

use Intervolga\Edu\Locator\Iblock\Property\AgePollResultProperty;
use Intervolga\Edu\Locator\Iblock\Property\ConnectRespondentProperty;
use Intervolga\Edu\Locator\Iblock\Property\GenderProperty;
use Intervolga\Edu\Locator\Iblock\Property\SalaryProperty;
use Intervolga\Edu\Locator\Iblock\ResultsPollingIblock;
use Intervolga\Edu\Tests\BaseTestIblock;

class TestResultsPollingIblock extends BaseTestIblock
{
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