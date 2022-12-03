<?php
namespace Intervolga\Edu\Util\ComponentTemplates;

use Bitrix\Main\IO\Directory;
use Intervolga\Edu\Util\FileSystem;

class ComplexComponentTemplate extends BaseComponentTemplate
{
	public function getInnerTemplatesDir(): Directory
	{
		return FileSystem::getInnerDirectory($this->directory, 'bitrix');
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
