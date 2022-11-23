<?php
namespace Intervolga\Edu\Tests\CourseOne\LessonOne;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Exceptions\TestException;

Loc::loadMessages(__FILE__);

class TestEdition extends \Intervolga\Edu\Tests\BaseTest
{
	public static function run()
	{
		require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/classes/general/update_client.php");

		$stableVersionsOnly = \COption::GetOptionString('main', 'stable_versions_only', 'Y');
		if (\CUpdateClient::Lock()) {
			if ($arUpdateList = \CUpdateClient::GetUpdatesList($errorMessage, LANG, $stableVersionsOnly)) {
				if ($license = $arUpdateList["CLIENT"][0]["@"]["LICENSE"]) {
					$translitLicense = \CUtil::translit($license, 'ru');
					if ($translitLicense != 'standart') {
						throw new TestException(Loc::getMessage('INTERVOLGA_EDU.INCORRECT_LICENSE', ['#LICENSE#' => $license]));
					}
				}
			} else {
				throw new TestException($errorMessage);
			}
			\CUpdateClient::UnLock();
		}
	}
}