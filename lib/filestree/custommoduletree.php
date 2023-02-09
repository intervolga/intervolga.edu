<?php
namespace Intervolga\Edu\FilesTree;

use Bitrix\Main\IO\Directory;
use Bitrix\Main\IO\File;
use Bitrix\Main\IO\FileNotFoundException;
use Intervolga\Edu\Util\FileSystem;

class CustomModuleTree extends ComponentTemplate
{
	public function getAdminDir(): Directory
	{
		return FileSystem::getInnerDirectory($this, 'admin');
	}

	public function getClassesDir(): Directory
	{
		return FileSystem::getInnerDirectory($this, 'classes');
	}

	public function getInstallDir(): Directory
	{
		return FileSystem::getInnerDirectory($this, 'install');
	}

	public function getLibDir(): Directory
	{
		return FileSystem::getInnerDirectory($this, 'lib');
	}

	public function getIncludeFile(): File
	{
		return FileSystem::getInnerFile($this, 'include.php');
	}

	public function getPrologFile(): File
	{
		return FileSystem::getInnerFile($this, 'prolog.php');
	}

	/**
	 * @return File[]
	 * @throws FileNotFoundException
	 */
	public function getKnownFiles(): array
	{
		$result = [
			$this->getIncludeFile(),
			$this->getPrologFile(),
		];

		return $result;
	}

	/**
	 * @return Directory[]
	 */
	public function getKnownDirs(): array
	{
		$result = [
			$this->getLangDir(),
			$this->getAdminDir(),
			$this->getClassesDir(),
			$this->getInstallDir(),
			$this->getLibDir(),
		];

		return $result;
	}

}