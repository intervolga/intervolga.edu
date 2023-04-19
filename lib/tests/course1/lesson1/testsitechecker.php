<?php
namespace Intervolga\Edu\Tests\Course1\Lesson1;

use Bitrix\Main\Application;
use Bitrix\Main\IO\File;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Type\Date;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;

Loc::loadMessages(__FILE__);

class TestSiteChecker extends BaseTest
{
	protected static function run()
	{
		$checkerTest = new \CSiteCheckerTest();
		$logFile = new File(Application::getDocumentRoot() . $checkerTest->LogFile);
		Assert::fseExists($logFile, Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_1_EMPTY_SITE_CHECK_LOG'));
		$re = '/(?<DATE>\d{4}-.{3}-\d{2} \d{2}:\d{2}:\d{2}) (?<TITLE>.*) \((?<CODE>.*)\): Fail\n(?<ERROR>.*)/m';
		preg_match_all($re, $logFile->getContents(), $matches, PREG_SET_ORDER);

		Assert::greaterEq($logFile->getModificationTime(), (new Date())->add('-3 day'), Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_1_SITE_CHECK_LOG_EXPIRED'));
		Assert::count($matches, 0);
	}
}