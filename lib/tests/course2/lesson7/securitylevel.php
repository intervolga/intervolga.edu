<?php
namespace Intervolga\Edu\Tests\Course2\Lesson7;

use Bitrix\Main\Localization\Loc;
use CAutoCheck;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;

class SecurityLevel extends BaseTest
{

	protected static function run()
	{
		include ($_SERVER["DOCUMENT_ROOT"].'/bitrix/modules/main/classes/general/checklist.php');
		$securityLevel = CAutoCheck::CheckSecurity(["ACTION" => "SECURITY_LEVEL"])["STATUS"];
		Assert::true($securityLevel, Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_7_SECURITYLEVEL'));
	}
}
