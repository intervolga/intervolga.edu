<?php
namespace Intervolga\Edu\FilesTree;

use Bitrix\Main\IO\File;
use Bitrix\Main\IO\FileNotFoundException;
use Intervolga\Edu\Util\FileSystem;

class GadgetTemplate extends FilesTree
{
	use Traits\FileSystemTrait;

	/**
	 * @return File[]
	 * @throws FileNotFoundException
	 */
	public function getKnownFiles(): array
	{
		$result = [
			$this->getIndexFile(),
			$this->getParametersFile(),
			$this->getDescriptionFile(),
		];

		return $result;
	}

	public function getParametersFile(): File
	{
		return FileSystem::getInnerFile($this, '.parameters.php');
	}

	public function getIndexFile(): File
	{
		return FileSystem::getInnerFile($this, 'index.php');
	}
}