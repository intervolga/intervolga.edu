<?php
namespace Intervolga\Edu\Tests\CourseOne\LessonOne;

use Intervolga\Edu\Exceptions\TestException;

class TestSiteChecker extends \Intervolga\Edu\Tests\BaseTest
{
	public static function run()
	{
		//view-source:https://es.ivsupport.ru/bitrix/admin/site_checker.php?lang=ru&read_log=Y&anchor=check_bx_crontab#check_bx_crontab
		$oTest = new \CSiteCheckerTest();
		$str = htmlspecialcharsEx(file_get_contents(\Bitrix\Main\Application::getDocumentRoot() . $oTest->LogFile));
	}
}