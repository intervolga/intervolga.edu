<?php
namespace Intervolga\Edu\Tests\Filesets;

use Bitrix\Main\IO\FileSystemEntry;

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
	 * @param string $regex
	 * @return Fileset
	 */
	public function getByRegex($regex)
	{
		$result = new Fileset();
		foreach ($this->fileSystemEntries as $fileSystemEntry) {
			$matches = [];
			preg_match_all($regex, $fileSystemEntry->getPath(), $matches, PREG_SET_ORDER);
			if ($matches) {
				$result->add($fileSystemEntry);
			}
		}

		return $result;
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
