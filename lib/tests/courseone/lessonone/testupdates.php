<?php
namespace Intervolga\Edu\Tests\CourseOne\LessonOne;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Exceptions\TestException;

Loc::loadMessages(__FILE__);

class TestUpdates extends \Intervolga\Edu\Tests\BaseTest
{
	public static function getErrors()
	{
		$errors = [];
		require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/classes/general/update_client.php');

		$stableVersionsOnly = \Bitrix\Main\Config\Option::get('main', 'stable_versions_only', 'Y');
		if (\CUpdateClient::Lock()) {
			if ($updatesList = \CUpdateClient::GetUpdatesList($errorMessage, LANG, $stableVersionsOnly)) {
				$errors[] = Loc::getMessage('INTERVOLGA_EDU.UPDATES_AVAILABLE', ['#COUNT#' => count($updatesList['MODULES'][0]['#']['MODULE'])]);
			} else {
				$errors[] = $errorMessage;
			}
			\CUpdateClient::UnLock();
		}

		return $errors;
	}
}