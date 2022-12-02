<?php
namespace Intervolga\Edu\Tests\Course1\Lesson1;

use Bitrix\Main\Application;
use Bitrix\Main\IO\File;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Assert;
use Intervolga\Edu\Tests\BaseTest;

Loc::loadMessages(__FILE__);

class TestSiteChecker extends BaseTest
{
	public static function run()
	{
		$checkerTest = new \CSiteCheckerTest();
		$logFile = new File(Application::getDocumentRoot() . $checkerTest->LogFile);
		Assert::fseExists($logFile, Loc::getMessage('INTERVOLGA_EDU.EMPTY_SITE_CHECK_LOG'));
		$re = '/(?<DATE>\d{4}-.{3}-\d{2} \d{2}:\d{2}:\d{2}) (?<TITLE>.*) \((?<CODE>.*)\): Fail\n(?<ERROR>.*)/m';
		preg_match_all($re, $logFile->getContents(), $matches, PREG_SET_ORDER);

		Assert::eq(
			count($matches),
			0
		);
	}
}