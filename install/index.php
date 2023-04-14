<?php
B_PROLOG_INCLUDED === true || die();

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

class intervolga_edu extends CModule
{
	var $MODULE_ID = 'intervolga.edu';

	/**
	 * @return string
	 */
	public static function getModuleId()
	{
		return basename(dirname(__DIR__));
	}

	public function __construct()
	{
		$arModuleVersion = [];
		include(dirname(__FILE__) . '/version.php');
		$this->MODULE_ID = self::getModuleId();
		$this->MODULE_VERSION = $arModuleVersion['VERSION'];
		$this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
		$this->MODULE_NAME = Loc::getMessage('INTERVOLGA_EDU.MODULE_NAME');
		$this->MODULE_DESCRIPTION = Loc::getMessage('INTERVOLGA_EDU.MODULE_DESC');

		$this->PARTNER_NAME = Loc::getMessage('INTERVOLGA_EDU.PARTNER_NAME');
		$this->PARTNER_URI = Loc::getMessage('INTERVOLGA_EDU.PARTNER_URI');
	}

	public function doInstall()
	{
		try {
			Main\ModuleManager::registerModule($this->MODULE_ID);
		} catch (\Exception $e) {
			global $APPLICATION;
			$APPLICATION->throwException($e->getMessage());

			return false;
		}

		return true;
	}

	public function doUninstall()
	{
		try {
			Main\ModuleManager::unRegisterModule($this->MODULE_ID);
		} catch (\Exception $e) {
			global $APPLICATION;
			$APPLICATION->throwException($e->getMessage());

			return false;
		}

		return true;
	}
}