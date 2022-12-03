<?php
namespace Intervolga\Edu\Util\ComponentTemplates;

use Bitrix\Main\IO\File;
use Intervolga\Edu\Util\FileSystem;

class NewsTemplate extends ComplexComponentTemplate
{
	public function getNewsFile(): File
	{
		return FileSystem::getInnerFile($this->directory, 'news.php');
	}

	public function getSectionFile(): File
	{
		return FileSystem::getInnerFile($this->directory, 'section.php');
	}

	public function getSearchFile(): File
	{
		return FileSystem::getInnerFile($this->directory, 'search.php');
	}

	public function getRssFile(): File
	{
		return FileSystem::getInnerFile($this->directory, 'rss.php');
	}

	public function getRssSectionFile(): File
	{
		return FileSystem::getInnerFile($this->directory, 'rss_section.php');
	}

	public function getDetailFile(): File
	{
		return FileSystem::getInnerFile($this->directory, 'detail.php');
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
