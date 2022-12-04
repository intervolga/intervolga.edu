<?php
namespace Intervolga\Edu\FilesTree;

use Bitrix\Main\IO\Directory;
use Bitrix\Main\IO\File;
use Bitrix\Main\IO\FileNotFoundException;
use Bitrix\Main\IO\FileSystemEntry;

abstract class FilesTree extends Directory
{
	/**
	 * @return File[]
	 */
	abstract public function getKnownPhpFiles(): array;

	/**
	 * @return FileSystemEntry[]
	 * @throws FileNotFoundException
	 */
	abstract public function getUnknownFileSystemEntries(): array;
}
