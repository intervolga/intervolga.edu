<?php
namespace Intervolga\Edu\Util;

use Bitrix\Main\IO\Directory;
use Bitrix\Main\IO\File;

class ComponentTemplate
{
	/**
	 * @var null|Directory
	 */
	protected $directory = null;

	public function __construct(Directory $directory)
	{
		$this->directory = $directory;
	}

	public function getLangDirectory(): Directory
	{
		return FileSystem::getInnerDirectory($this->directory, 'lang');
	}

	public function getLangRuDirectory(): Directory
	{
		$langDirectory = $this->getLangDirectory();

		return FileSystem::getInnerDirectory($langDirectory, 'ru');
	}

	/**
	 * @return Directory[]
	 * @throws \Bitrix\Main\IO\FileNotFoundException
	 */
	public function getLangForeignDirectories()
	{
		$result = [];
		$langDirectory = $this->getLangDirectory();
		foreach ($langDirectory->getChildren() as $item) {
			if ($item->getName() != 'ru')
			{
				$result[] = $item;
			}
		}

		return $result;
	}

	public function getImagesDirectory()
	{
		return FileSystem::getInnerDirectory($this->directory, 'images');
	}

	/**
	 * @return File[]
	 * @throws \Bitrix\Main\IO\FileNotFoundException
	 */
	public function getCssFiles()
	{
		$result = [];
		foreach ($this->directory->getChildren() as $item) {
			if ($item instanceof File)
			{
				if ($item->getExtension() == 'css')
				{
					$result[] = $item;
				}
			}
		}
		return $result;
	}

	/**
	 * @return File[]
	 * @throws \Bitrix\Main\IO\FileNotFoundException
	 */
	public function getJsFiles()
	{
		$result = [];
		foreach ($this->directory->getChildren() as $item) {
			if ($item instanceof File)
			{
				if ($item->getExtension() == 'js')
				{
					$result[] = $item;
				}
			}
		}
		return $result;
	}

	public function getDescriptionFile(): File
	{
		return FileSystem::getInnerFile($this->directory, '.description.php');
	}

	public function getParametersFile(): File
	{
		return FileSystem::getInnerFile($this->directory, '.parameters.php');
	}

	public function getInnerTemplatesDirectory(): Directory
	{
		return FileSystem::getInnerDirectory($this->directory, 'bitrix');
	}

	public function getResultModifier(): File
	{
		return FileSystem::getInnerFile($this->directory, 'result_modifier.php');
	}

	public function getComponentEpilog(): File
	{
		return FileSystem::getInnerFile($this->directory, 'component_epilog.php');
	}

	public function getTemplate(): File
	{
		return FileSystem::getInnerFile($this->directory, 'template.php');
	}

	public function getUnknownFiles()
	{
		$result = [];
		foreach ($this->directory->getChildren() as $item) {
			if ($item instanceof File)
			{

			}
		}
		return $result;
	}

	public function getUnknownDirectories()
	{
		$result = [];
		foreach ($this->directory->getChildren() as $item) {
			if ($item instanceof Directory)
			{

			}
		}
		return $result;
	}
}
