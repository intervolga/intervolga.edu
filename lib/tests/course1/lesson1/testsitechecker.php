<?php
namespace Intervolga\Edu\Tests\Course1\Lesson1;

use Bitrix\Main\Application;
use Bitrix\Main\IO\File;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Util\BaseTest;

Loc::loadMessages(__FILE__);

class TestSiteChecker extends BaseTest
{
	public static function run()
	{
		$checkerTest = new \CSiteCheckerTest();
		$log = File::getFileContents(Application::getDocumentRoot() . $checkerTest->LogFile);
		if (strlen($log)) {
			$re = '/(?<date>\d{4}-.{3}-\d{2} \d{2}:\d{2}:\d{2}) (?<title>.*) \((?<code>.*)\): Fail\n(?<error>.*)/m';
			preg_match_all($re, $log, $matches, PREG_SET_ORDER, 0);
			foreach ($matches as $match) {
				static::registerError(Loc::getMessage('INTERVOLGA_EDU.SITE_CHECK_ERROR', [
					'#DATE#' => $match['date'],
					'#TITLE#' => $match['title'],
					'#CODE#' => $match['code'],
					'#ERROR#' => htmlspecialchars(TruncateText($match['error'], 50)),
				]));
			}
		} else {
			static::registerError(Loc::getMessage('INTERVOLGA_EDU.EMPTY_SITE_CHECK_LOG'));
		}
	}
}