<?php
namespace Intervolga\Edu\Tests\CourseOne\LessonOne;

use Bitrix\Main\Application;
use Bitrix\Main\IO\File;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Exceptions\TestException;

Loc::loadMessages(__FILE__);

class TestSiteChecker extends \Intervolga\Edu\Tests\BaseTest
{
	public static function getErrors()
	{
		$errors = [];
		$checkerTest = new \CSiteCheckerTest();
		$log = File::getFileContents(Application::getDocumentRoot() . $checkerTest->LogFile);
		if (strlen($log))
		{
			$re = '/(?<date>\d{4}-.{3}-\d{2} \d{2}:\d{2}:\d{2}) (?<title>.*) \((?<code>.*)\): Fail/m';
			preg_match_all($re, $log, $matches, PREG_SET_ORDER, 0);

			foreach ($matches as $match) {
				$errors[] = Loc::getMessage('INTERVOLGA_EDU.SITE_CHECK_ERROR', [
					'#DATE#' => $match['date'],
					'#TITLE#' => $match['title'],
					'#CODE#' => $match['code']
				]);
			}
		}
		else
		{
			$errors[] = Loc::getMessage('INTERVOLGA_EDU.EMPTY_SITE_CHECK_LOG');
		}

		return $errors;
	}
}