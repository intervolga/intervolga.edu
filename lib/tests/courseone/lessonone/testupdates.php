<?php
namespace Intervolga\Edu\Tests\CourseOne\LessonOne;

use Bitrix\Main\Application;
use Bitrix\Main\Config\Option;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Tests\BaseTest;

Loc::loadMessages(__FILE__);

class TestUpdates extends BaseTest
{
	public static function run()
	{
		$errors = [];
		require_once(Application::getDocumentRoot() . '/bitrix/modules/main/classes/general/update_client.php');

		$stableVersionsOnly = Option::get('main', 'stable_versions_only', 'Y');
		if (\CUpdateClient::lock()) {
			if ($updatesList = \CUpdateClient::getUpdatesList($errorMessage, LANG, $stableVersionsOnly)) {
				static::registerError(Loc::getMessage('INTERVOLGA_EDU.UPDATES_AVAILABLE', ['#COUNT#' => count($updatesList['MODULES'][0]['#']['MODULE'])]));
			} else {
				static::registerError($errorMessage);
			}
			\CUpdateClient::unLock();
		}
	}
}