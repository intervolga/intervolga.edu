<?php
namespace Intervolga\Edu\Util;

use Bitrix\Main\Application;
use Bitrix\Main\Config\Option;
use Intervolga\Edu\Exceptions\TestException;

class UpdateSystem
{
	/**
	 * @var array
	 */
	protected static $updateStatus = [];

	/**
	 * @return array
	 * @throws TestException
	 */
	public static function getStatus()
	{
		if (!static::$updateStatus) {
			static::$updateStatus = static::getUpdatesList();
		}

		return [
			'LICENSE' => static::$updateStatus['CLIENT'][0]['@']['LICENSE'],
			'MODULES' => static::$updateStatus['MODULES'][0]['#']['MODULE'],
		];
	}

	/**
	 * @return array
	 * @throws TestException
	 */
	protected static function getUpdatesList()
	{
		require_once(Application::getDocumentRoot() . '/bitrix/modules/main/classes/general/update_client.php');

		$result = [];

		if (\CUpdateClient::lock()) {
			$errorMessage = '';
			$stableVersionsOnly = Option::get('main', 'stable_versions_only', 'Y');
			$updatesList = \CUpdateClient::getUpdatesList($errorMessage, LANG, $stableVersionsOnly);
			\CUpdateClient::unLock();
			if ($updatesList) {
				$result = $updatesList;
			} else {
				throw new TestException($errorMessage);
			}
		}

		return $result;
	}
}
