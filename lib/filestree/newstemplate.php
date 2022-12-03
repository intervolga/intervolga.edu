<?php
namespace Intervolga\Edu\FilesTree;

use Bitrix\Main\IO\File;
use Intervolga\Edu\Util\FileSystem;

class NewsTemplate extends ComplexComponentTemplate
{
	public function getNewsFile(): File
	{
		return FileSystem::getInnerFile($this, 'news.php');
	}

	public function getSectionFile(): File
	{
		return FileSystem::getInnerFile($this, 'section.php');
	}

	public function getSearchFile(): File
	{
		return FileSystem::getInnerFile($this, 'search.php');
	}

	public function getRssFile(): File
	{
		return FileSystem::getInnerFile($this, 'rss.php');
	}

	public function getRssSectionFile(): File
	{
		return FileSystem::getInnerFile($this, 'rss_section.php');
	}

	public function getDetailFile(): File
	{
		return FileSystem::getInnerFile($this, 'detail.php');
	}

	/**
	 * @return File[]
	 * @throws \Bitrix\Main\IO\FileNotFoundException
	 */
	public function getKnownFiles(): array
	{
		$result = parent::getKnownFiles();
		$result[] = $this->getNewsFile();
		$result[] = $this->getDetailFile();
		$result[] = $this->getSectionFile();
		$result[] = $this->getSearchFile();
		$result[] = $this->getRssFile();
		$result[] = $this->getRssSectionFile();

		return $result;
	}
}
