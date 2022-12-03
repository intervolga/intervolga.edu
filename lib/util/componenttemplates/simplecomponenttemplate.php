<?php
namespace Intervolga\Edu\Util\ComponentTemplates;

use Bitrix\Main\IO\File;
use Intervolga\Edu\Util\FileSystem;

class SimpleComponentTemplate extends BaseComponentTemplate
{
	public function getTemplateFile(): File
	{
		return FileSystem::getInnerFile($this, 'template.php');
	}

	/**
	 * @return File[]
	 * @throws \Bitrix\Main\IO\FileNotFoundException
	 */
	public function getKnownFiles(): array
	{
		$result = parent::getKnownFiles();
		$result[] = $this->getTemplateFile();

		return $result;
	}
}
