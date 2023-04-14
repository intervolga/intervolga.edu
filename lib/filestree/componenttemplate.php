<?php
namespace Intervolga\Edu\FilesTree;

use Bitrix\Main\IO\Directory;
use Bitrix\Main\IO\File;
use Bitrix\Main\IO\FileNotFoundException;
use Bitrix\Main\IO\FileSystemEntry;
use Intervolga\Edu\Util\FileSystem;

abstract class ComponentTemplate extends FilesTree
{
	public function getLangRuDir(): Directory
	{
		$langDirectory = $this->getLangDir();

		return FileSystem::getInnerDirectory($langDirectory, 'ru');
	}

	public function getLangDir(): Directory
	{
		return FileSystem::getInnerDirectory($this, 'lang');
	}

	/**
	 * @return Directory[]
	 * @throws FileNotFoundException
	 */
	public function getLangForeignDirs(): array
	{
		$result = [];
		$langDirectory = $this->getLangDir();
		if ($langDirectory->isExists()) {
			foreach ($langDirectory->getChildren() as $item) {
				if ($item->getName() != 'ru') {
					$result[] = $item;
				}
			}
		}

		return $result;
	}

	public function getKnownPhpFiles(): array
	{
		$result = [];
		foreach ($this->getKnownFiles() as $knownFile) {
			if ($knownFile->getExtension() == 'php') {
				$result[] = $knownFile;
			}
		}

		return $result;
	}

	/**
	 * @return File[]
	 * @throws FileNotFoundException
	 */
	abstract public function getKnownFiles(): array;

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

	public function getImagesDir(): Directory
	{
		return FileSystem::getInnerDirectory($this, 'images');
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
}
