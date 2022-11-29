<?php
namespace Intervolga\Edu\Util;

use Bitrix\Main\IO\FileSystemEntry;

/**
 * @deprecated а зачем?
 */
class Fileset
{
	protected $fileSystemEntries = [];

	/**
	 * @param FileSystemEntry[] $fileEntries
	 */
	public function __construct(array $fileEntries = [])
	{
		$this->fileSystemEntries = $fileEntries;
	}

	/**
	 * @return FileSystemEntry[]
	 */
	public function getFileSystemEntries()
	{
		return $this->fileSystemEntries;
	}

	/**
	 * @param FileSystemEntry $fileEntry
	 */
	public function add(FileSystemEntry $fileEntry)
	{
		$this->fileSystemEntries[] = $fileEntry;
	}

	/**
	 * @param Fileset $other
	 */
	public function addFileset(Fileset $other)
	{
		foreach ($other->fileSystemEntries as $fileEntry) {
			$this->add($fileEntry);
		}
	}
}
