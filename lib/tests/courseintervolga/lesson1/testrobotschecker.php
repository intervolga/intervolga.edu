<?php
namespace Intervolga\Edu\Tests\CourseIntervolga\Lesson1;

use Bitrix\Main\Localization\Loc;
use Bitrix\Seo\RobotsFile;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\Regex;

class TestRobotsChecker extends BaseTest
{
	protected static function run()
	{
		$robotsFile = new RobotsFile(SITE_ID);
		Assert::true($robotsFile->isExists(), Loc::getMessage('INTERVOLGA_EDU.COURSE_INTERVOLGA_ROBOTS_NOT_FOUND'));
		Assert::fileContentMatches($robotsFile, new Regex ('/User-agent:\s*\*\s*[\w\s\d\/\:\.\=\_\?\&\*]*Disallow:\s*\/\s*$/im', ''), Loc::getMessage('INTERVOLGA_EDU.COURSE_INTERVOLGA_ROBOTS_NOT_MATCH'));
	}
}