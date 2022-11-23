<?php
namespace Intervolga\Edu\Tests\CourseOne\LessonOne;

use Bitrix\Main\Application;
use Bitrix\Main\Config\Option;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Tests\BaseTest;

Loc::loadMessages(__FILE__);

class TestEdition extends BaseTest
{
	public static function run()
	{
		require_once(Application::getDocumentRoot() . '/bitrix/modules/main/classes/general/update_client.php');

		$stableVersionsOnly = Option::get('main', 'stable_versions_only', 'Y');
		if (\CUpdateClient::lock()) {
			if ($arUpdateList = \CUpdateClient::getUpdatesList($errorMessage, LANG, $stableVersionsOnly)) {
				if ($license = $arUpdateList['CLIENT'][0]['@']['LICENSE']) {
					$translitLicense = \CUtil::translit($license, 'ru');
					if ($translitLicense != 'standart') {
						static::registerError(Loc::getMessage('INTERVOLGA_EDU.INCORRECT_LICENSE', ['#LICENSE#' => $license]));
					}
				}
			} else {
				static::registerError($errorMessage);
			}
			\CUpdateClient::unLock();
		}
	}
}