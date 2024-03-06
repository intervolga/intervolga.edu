<?php
namespace Intervolga\Edu\Tests\Course1New\Lesson4;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\FileMessage;
use Intervolga\Edu\Util\FileSystem;
use Intervolga\Edu\Util\Regex;

class TestDBConn extends BaseTest
{
	protected static function run()
	{
		$dbconnFile = FileSystem::getFile("/bitrix/php_interface/dbconn.php");
		Assert::fseExists($dbconnFile);
		Assert::fileContentMatches($dbconnFile, new Regex('/\$DBDebugToFile\s*=\s*false/', ''),
			Loc::getMessage('IV_EDU.NEW_ACADEMY.C_1.L_4.DBCONN',
				[
					'#FILE#' => FileMessage::get($dbconnFile),
				]
			));
	}
}