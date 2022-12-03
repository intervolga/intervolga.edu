<?php
namespace Intervolga\Edu\FilesTree;

use Bitrix\Main\IO\Directory;
use Intervolga\Edu\Util\FileSystem;

class ComplexComponentTemplate extends ComponentTemplate
{
	public function getInnerTemplatesDir(): Directory
	{
		return FileSystem::getInnerDirectory($this, 'bitrix');
	}

	/**
	 * @return Directory[]
	 */
	public function getKnownDirs(): array
	{
		$result = parent::getKnownDirs();
		$result[] = $this->getInnerTemplatesDir();

		return $result;
	}
}
