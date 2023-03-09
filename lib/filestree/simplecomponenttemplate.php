<?php
namespace Intervolga\Edu\FilesTree;

use Bitrix\Main\IO\File;
use Intervolga\Edu\Util\FileSystem;

class SimpleComponentTemplate extends ComponentTemplate
{
	/**
	 * @return File[]
	 * @throws \Bitrix\Main\IO\FileNotFoundException
	 */
	public function getKnownFiles(): array
	{
		$result = [
			$this->getComponentEpilogFile(),
			$this->getParametersFile(),
			$this->getResultModifier(),
			$this->getDescriptionFile(),
			$this->getTemplateFile()
		];
		$result = array_merge($result, $this->getJsFiles());
		$result = array_merge($result, $this->getCssFiles());

		return $result;
	}

	public function getTemplateFile(): File
	{
		return FileSystem::getInnerFile($this, 'template.php');
	}
}
