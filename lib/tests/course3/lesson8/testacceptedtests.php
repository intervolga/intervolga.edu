<?php
namespace Intervolga\Edu\Tests\Course3\Lesson8;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;

class TestAcceptedTests extends BaseTest
{
	protected static function run()
	{
		$checklist = new \CCheckList();

		$securityStat = $checklist->GetSectionStat('QSECURITY');
		$total = $securityStat['TOTAL'];
		$check = $securityStat['CHECK'];
		Assert::eq($check, $total, Loc::getMessage('INTERVOLGA_EDU.WAS_NOT_MADE_FROM_SECURITY', [
			'#CURRENT#' => $check,
			'#REQUIRED#' => $total
		]));

		$points = $checklist->GetPoints('QPROJECT');;
		$codes = [
			'QJ0030',
			'QJ0040'
		];
		foreach ($codes as $code) {
			$point = $points[$code];
			Assert::eq($point['STATE']['STATUS'], 'A', Loc::getMessage('INTERVOLGA_EDU.WAS_NOT_MADE', [
				'#NAME#' => $point['NAME']
			]));
		}
	}

	public static function interceptErrors()
	{
		return true;
	}
}