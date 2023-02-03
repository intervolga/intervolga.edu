<?php
namespace Intervolga\Edu\FilesTree;

use Bitrix\Main\IO\Directory;
use Bitrix\Main\IO\File;
use Intervolga\Edu\Util\FileSystem;

class CustomVacanciesTree extends ComponentTemplate
{
	public static function getTemplateTree(): string
	{
		return CustomVacanciesTemplate::class;
	}

	public function getTemplatesDir(): Directory
	{
		return FileSystem::getInnerDirectory($this, 'templates');
	}

	/**
	 * @return File[]
	 * @throws \Bitrix\Main\IO\FileNotFoundException
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