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

		try {
			$license = static::$updateStatus['CLIENT'][0]['@']['LICENSE'];
		} catch (\Throwable $throw) {
			$license = $throw->getMessage().'<br>'.$throw->getFile().' '.$throw->getLine();
		}
		try {
			$modules = static::$updateStatus['MODULES'][0]['#'] ? static::$updateStatus['MODULES'][0]['#']['MODULE'] : [];
		} catch (\Throwable $throw) {
			$modules = $throw->getMessage().'<br>'.$throw->getFile().' '.$throw->getLine();
		}

		return [
			'LICENSE' => $license,
			'MODULES' => $modules,
			'UPDATE_SYSTEM' => static::$updateStatus['UPDATE_SYSTEM'],
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
