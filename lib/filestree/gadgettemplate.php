<?php
namespace Intervolga\Edu\FilesTree;

use Bitrix\Main\IO\File;
use Bitrix\Main\IO\FileNotFoundException;
use Intervolga\Edu\Util\FileSystem;

class GadgetTemplate extends ComponentTemplate
{
	/**
	 * @return File[]
	 * @throws FileNotFoundException
	 */
	public function getKnownFiles(): array
	{
		$result = [
			$this->getTemplateFile(),
			$this->getParametersFile(),
			$this->getDescriptionFile(),
		];

		return $result;
	}

	public function getTemplateFile(): File
	{
		return FileSystem::getInnerFile($this, 'index.php');
	}
}