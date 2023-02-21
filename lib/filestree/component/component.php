<?php
namespace Intervolga\Edu\FilesTree\Component;

use Bitrix\Main\IO\Directory;
use Bitrix\Main\IO\File;
use Bitrix\Main\IO\FileNotFoundException;
use Bitrix\Main\IO\FileSystemEntry;
use Intervolga\Edu\FilesTree\FilesTree;
use Intervolga\Edu\Util\FileSystem;

abstract class Component extends FilesTree
{
	abstract public static function getTemplateTree(): string;

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
	public function getKnownFiles(): array
	{
		$result = [
			$this->getComponentFile(),
			$this->getClassFile(),
			$this->getDescriptionFile(),
			$this->getParametersFile(),
		];

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

	public function getDescriptionFile(): File
	{
		return FileSystem::getInnerFile($this, '.description.php');
	}

	public function getParametersFile(): File
	{
		return FileSystem::getInnerFile($this, '.parameters.php');
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
			$this->getLangDir(),
			$this->getTemplatesDir(),
		];

		return $result;
	}

	public function getTemplatesDir(): Directory
	{
		return FileSystem::getInnerDirectory($this, 'templates');
	}
}