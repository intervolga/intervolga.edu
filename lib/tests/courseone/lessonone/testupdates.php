<?php
namespace Intervolga\Edu\Tests\CourseOne\LessonOne;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Exceptions\TestException;

Loc::loadMessages(__FILE__);

class TestUpdates extends \Intervolga\Edu\Tests\BaseTest
{
	public static function run()
	{
		require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/classes/general/update_client.php');

		$stableVersionsOnly = \Bitrix\Main\Config\Option::get('main', 'stable_versions_only', 'Y');
		if (\CUpdateClient::Lock()) {
			if ($updatesList = \CUpdateClient::GetUpdatesList($errorMessage, LANG, $stableVersionsOnly)) {
				echo '<pre>' . __FILE__ . ':' . __LINE__ . ':<br>' . print_r($updatesList['MODULES'][0]['#']['MODULE'], true) . '</pre>';
				echo '<pre>' . __FILE__ . ':' . __LINE__ . ':<br>' . print_r(Option::get('main', 'update_system_update', '-'), true) . '</pre>';
			} else {
				throw new TestException($errorMessage);
			}
			\CUpdateClient::UnLock();
		}
	}
}