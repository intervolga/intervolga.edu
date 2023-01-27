<?php
namespace Intervolga\Edu\FilesTree;

use Bitrix\Main\IO\Directory;
use Bitrix\Main\IO\File;
use Bitrix\Main\IO\FileNotFoundException;
use Intervolga\Edu\Util\FileSystem;

class SimpleComponent extends ComponentTemplate
{
	public static function getTemplateTree(): string
	{
		return SimpleComponentTemplate::class;
	}

	public function getTemplatesDir(): Directory
	{
		return FileSystem::getInnerDirectory($this, 'templates');
	}

	/**
	 * @return File[]
	 * @throws FileNotFoundException
	 */
	public function getKnownFiles(): array
	{
		$result = parent::getKnownFiles();
		$result[] = $this->getComponentFile();
		$result[] = $this->getClassFile();

		return $result;
	}

	public function getComponentFile(): File
	{
		return FileSystem::getInnerFile($this, 'component.php');
	}

	public function getClassFile(): File
	{
		return FileSystem::getInnerFile($this, 'class.php');
	}
}