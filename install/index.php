<?php
B_PROLOG_INCLUDED === true || die();

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Application;

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

	public function DoInstall()
	{
		try {
			Main\ModuleManager::registerModule($this->MODULE_ID);
			$this->InstallFiles();
		} catch (\Exception $e) {
			global $APPLICATION;
			$APPLICATION->throwException($e->getMessage());

			return false;
		}

		return true;
	}

	public function DoUninstall()
	{
		try {
			Main\ModuleManager::unRegisterModule($this->MODULE_ID);
			$this->UninstallFiles();
		} catch (\Exception $e) {
			global $APPLICATION;
			$APPLICATION->throwException($e->getMessage());

			return false;
		}

		return true;
	}

	public function InstallFiles()
	{
		$root = Application::getDocumentRoot();
		$curDir = getLocalPath('modules/' . $this->MODULE_ID);
		copyDirFiles(
			$root . $curDir .  '/install/js',
			$root . '/bitrix/js/' . $this->MODULE_ID,
			true,
			true
		);
		copyDirFiles(
			$root . $curDir .  '/install/images',
			$root . '/bitrix/images/' . $this->MODULE_ID,
			true,
			true
		);
		copyDirFiles(
			$root . $curDir .  '/install/admin',
			$root . '/bitrix/admin/'
		);
	}

	public function UninstallFiles()
	{
		$root = Application::getDocumentRoot();
		$curDir = getLocalPath('modules/' . $this->MODULE_ID);
		deleteDirFiles(
			$root . $curDir .  '/install/js',
			$root . '/bitrix/js/' . $this->MODULE_ID
		);
		deleteDirFiles(
			$root . $curDir .  '/install/images',
			$root . '/bitrix/images/' . $this->MODULE_ID
		);
	}
}