<?php
namespace Intervolga\Edu\Tests\Course1New\Lesson3;

use Bitrix\Main\Localization\Loc;
use Bitrix\Seo\RobotsFile;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\Regex;

class TestRobots extends BaseTest
{
	protected static function run()
	{
		$robotsFile = new RobotsFile(SITE_ID);
		Assert::true($robotsFile->isExists(), Loc::getMessage('IV_EDU.NEW_ACADEMY.C_1.L_3.ROBOTS_NOT_FOUND'));

		Assert::fileContentMatches($robotsFile, new Regex ('/User-agent:\s\*\s*Disallow:\s\//i', '123'),
			Loc::getMessage('IV_EDU.NEW_ACADEMY.C_1.L_3.ROBOTS_NOT_MATCH'));
	}
}