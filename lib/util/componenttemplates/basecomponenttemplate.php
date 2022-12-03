<?php
namespace Intervolga\Edu\Util\ComponentTemplates;

use Bitrix\Main\IO\Directory;
use Bitrix\Main\IO\File;
use Bitrix\Main\IO\FileNotFoundException;
use Bitrix\Main\IO\FileSystemEntry;
use Intervolga\Edu\Util\FileSystem;

abstract class BaseComponentTemplate extends Directory
{
	public function getLangDir(): Directory
	{
		return FileSystem::getInnerDirectory($this, 'lang');
	}

	public function getLangRuDir(): Directory
	{
		$langDirectory = $this->getLangDir();

		return FileSystem::getInnerDirectory($langDirectory, 'ru');
	}

	/**
	 * @return Directory[]
	 * @throws FileNotFoundException
	 */
	public function getLangForeignDirs(): array
	{
		$result = [];
		$langDirectory = $this->getLangDir();
		foreach ($langDirectory->getChildren() as $item) {
			if ($item->getName() != 'ru') {
				$result[] = $item;
			}
		}

		return $result;
	}

	public function getImagesDir(): Directory
	{
		return FileSystem::getInnerDirectory($this, 'images');
	}

	/**
	 * @return File[]
	 * @throws FileNotFoundException
	 */
	public function getCssFiles(): array
	{
		$result = [];
		foreach ($this->getChildren() as $item) {
			if ($item instanceof File) {
				if ($item->getExtension() == 'css') {
					$result[] = $item;
				}
			}
		}

		return $result;
	}

	/**
	 * @return File[]
	 * @throws FileNotFoundException
	 */
	public function getJsFiles(): array
	{
		$result = [];
		foreach ($this->getChildren() as $item) {
			if ($item instanceof File) {
				if ($item->getExtension() == 'js') {
					$result[] = $item;
				}
			}
		}

		return $result;
	}

	public function getDescriptionFile(): File
	{
		return FileSystem::getInnerFile($this, '.description.php');
	}

	public function getParametersFile(): File
	{
		return FileSystem::getInnerFile($this, '.parameters.php');
	}

	public function getResultModifier(): File
	{
		return FileSystem::getInnerFile($this, 'result_modifier.php');
	}

	public function getComponentEpilogFile(): File
	{
		return FileSystem::getInnerFile($this, 'component_epilog.php');
	}

	/**
	 * @return File[]
	 * @throws FileNotFoundException
	 */
	public function getKnownFiles(): array
	{
		$result = [
			$this->getComponentEpilogFile(),
			$this->getParametersFile(),
			$this->getDescriptionFile(),
		];
		$result = array_merge($result, $this->getJsFiles());
		$result = array_merge($result, $this->getCssFiles());

		return $result;
	}

	/**
	 * @return Directory[]
	 */
	public function getKnownDirs(): array
	{
		$result = [
			$this->getImagesDir(),
			$this->getLangDir(),
		];

		return $result;
	}

	/**
	 * @return FileSystemEntry[]
	 * @throws FileNotFoundException
	 */
	public function getUnknownFileSystemEntries(): array
	{
		$result = [];
		foreach ($this->getChildren() as $item) {
			$found = false;
			if ($item->isFile()) {
				foreach ($this->getKnownFiles() as $knownFile) {
					if (FileSystem::isSame($item, $knownFile)) {
						$found = true;
					}
				}
			} elseif ($item->isDirectory()) {
				foreach ($this->getKnownDirs() as $knownDir) {
					if (FileSystem::isSame($item, $knownDir)) {
						$found = true;
					}
				}
			}
			if (!$found) {
				$result[] = $item;
			}
		}

		return $result;
	}
}
