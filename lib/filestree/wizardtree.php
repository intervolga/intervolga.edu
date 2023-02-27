<?php
namespace Intervolga\Edu\FilesTree;

use Bitrix\Main\IO\Directory;
use Bitrix\Main\IO\File;
use Bitrix\Main\IO\FileNotFoundException;
use Intervolga\Edu\Util\FileSystem;

class WizardTree extends FilesTree
{
	use MainFunctions;
	/**
	 * @return File[]
	 * @throws FileNotFoundException
	 */
	public function getKnownFiles(): array
	{
		$result = [
			$this->getVersionFile(),
			$this->getWizardFile(),
			$this->getDescriptionFile(),
		];

		return $result;
	}

	public function getVersionFile(): File
	{
		return FileSystem::getInnerFile($this, 'version.php');
	}

	public function getWizardFile(): File
	{
		return FileSystem::getInnerFile($this, 'wizard.php');
	}

	/**
	 * @return Directory[]
	 */
	public function getKnownDirs(): array
	{
		$result = [
			$this->getLangDir(),
		];

		return $result;
	}
}