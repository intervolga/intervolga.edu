<?php
B_PROLOG_INCLUDED === true || die();

use Bitrix\Main;
use Bitrix\Main\Application;
use Bitrix\Main\EventManager;
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

class intervolga_edu extends CModule
{
	var $MODULE_ID = 'intervolga.edu';

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

	/**
	 * @return string
	 */
	public static function getModuleId()
	{
		return basename(dirname(__DIR__));
	}

	public function DoInstall()
	{
		try {
			Main\ModuleManager::registerModule($this->MODULE_ID);
			$this->installDb();
			$this->InstallFiles();
			$this->InstallEvents();
		} catch (\Exception $e) {
			global $APPLICATION;
			$APPLICATION->throwException($e->getMessage());

			return false;
		}

		return true;
	}

	public function installDb()
	{//добавить курс

		global $DB, $DBType;
		$errors = $DB->RunSQLBatch(__DIR__ . "/db/" . strtolower($DBType) . "/install.sql");
		if ($errors) {
			throw new \Exception(implode("<br>", $errors));
		}

		return true;
	}

	public function InstallFiles()
	{
		$root = Application::getDocumentRoot();
		$curDir = getLocalPath('modules/' . $this->MODULE_ID);
		copyDirFiles(
			$root . $curDir . '/install/js',
			$root . '/bitrix/js/' . $this->MODULE_ID,
			true,
			true
		);
		copyDirFiles(
			$root . $curDir . '/install/css',
			$root . '/bitrix/css/' . $this->MODULE_ID,
			true,
			true
		);
		copyDirFiles(
			$root . $curDir . '/install/images',
			$root . '/bitrix/images/' . $this->MODULE_ID,
			true,
			true
		);
		copyDirFiles(
			$root . $curDir . '/install/admin',
			$root . '/bitrix/admin',
			true,
			true
		);
		\Bitrix\Main\Config\Option::set("main", "save_original_file_name", "Y");
	}

	function InstallEvents()
	{
		EventManager::getInstance()->registerEventHandler(
			'main',
			'OnPanelCreate',
			$this->MODULE_ID,
			'Intervolga\\Edu\\EventHandlers\\Main',
			'OnPanelCreateHandler'
		);
	}

	public function DoUninstall()
	{
		try {
			Main\ModuleManager::unRegisterModule($this->MODULE_ID);
			$this->UninstallDb();
			$this->UninstallFiles();
			$this->UnInstallEvents();
		} catch (\Exception $e) {
			global $APPLICATION;
			$APPLICATION->throwException($e->getMessage());

			return false;
		}

		return true;
	}

	public function UninstallDb()
	{
		global $DB, $DBType;
		$errors = $DB->RunSQLBatch(__DIR__ . "/db/" . strtolower($DBType) . "/uninstall.sql");
		if ($errors) {
			throw new \Exception(implode("<br>", $errors));
		}

		return true;
	}

	public function UninstallFiles()
	{
		$root = Application::getDocumentRoot();
		$curDir = getLocalPath('modules/' . $this->MODULE_ID);
		deleteDirFiles(
			$root . $curDir . '/install/js',
			$root . '/bitrix/js/' . $this->MODULE_ID
		);
		deleteDirFiles(
			$root . $curDir . '/install/css',
			$root . '/bitrix/css/' . $this->MODULE_ID
		);
		deleteDirFiles(
			$root . $curDir . '/install/images',
			$root . '/bitrix/images/' . $this->MODULE_ID
		);
		deleteDirFiles(
			$root . $curDir . '/install/admin',
			$root . '/bitrix/admin',
		);
	}

	function UnInstallEvents()
	{
		EventManager::getInstance()->unRegisterEventHandler(
			'main',
			'OnPanelCreate',
			$this->MODULE_ID,
			'Intervolga\\Edu\\EventHandlers\\Main',
			'OnPanelCreateHandler'
		);
	}

}