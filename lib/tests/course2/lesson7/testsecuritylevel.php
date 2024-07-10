<?php
namespace Intervolga\Edu\Tests\Course2\Lesson7;

use Bitrix\Main\Application;
use Bitrix\Main\Localization\Loc;
use CAutoCheck;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;

class TestSecurityLevel extends BaseTest
{
	public static function interceptErrors()
	{
		return true;
	}

	protected static function run()
	{
		include(Application::getDocumentRoot() . '/bitrix/modules/main/classes/general/checklist.php');
		$level = CAutoCheck::CheckSecurity(['ACTION' => 'SECURITY_LEVEL']);
		$securityLevel = $level['STATUS'];
		Assert::true(
			$securityLevel,
			Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_7_SECURITYLEVEL'),
		);
	}
}
