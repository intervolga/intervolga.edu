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

	public function getComponentEpilogFile(): File
	{
		return FileSystem::getInnerFile($this, 'component_epilog.php');
	}

	public function getParametersFile(): File
	{
		return FileSystem::getInnerFile($this, '.parameters.php');
	}

	public function getResultModifier(): File
	{
		return FileSystem::getInnerFile($this, 'result_modifier.php');
	}

	public function getDescriptionFile(): File
	{
		return FileSystem::getInnerFile($this, '.description.php');
	}

	public function getTemplateFile(): File
	{
		return FileSystem::getInnerFile($this, 'template.php');
	}
}
