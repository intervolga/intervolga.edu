<?php
namespace Intervolga\Edu\FilesTree\Traits;

use Bitrix\Main\IO\Directory;
use Bitrix\Main\IO\File;
use Bitrix\Main\IO\FileNotFoundException;
use Bitrix\Main\IO\FileSystemEntry;
use Intervolga\Edu\Util\FileSystem;

trait FileSystemTrait
{
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

	public function getDescriptionFile(): File
	{
		return FileSystem::getInnerFile($this, '.description.php');
	}

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
		if ($langDirectory->isExists()) {
			foreach ($langDirectory->getChildren() as $item) {
				if ($item->getName() != 'ru') {
					$result[] = $item;
				}
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
		];

		return $result;
	}
}