<?php
namespace Intervolga\Edu\FilesTree\ComponentTemplate;

use Bitrix\Main\IO\Directory;
use Bitrix\Main\IO\File;
use Intervolga\Edu\FilesTree\ComplexComponentTemplate;
use Intervolga\Edu\FilesTree\SimpleComponentTemplate;
use Intervolga\Edu\Util\FileSystem;

class NewsTemplate extends ComplexComponentTemplate
{
	/**
	 * @return File[]
	 * @throws \Bitrix\Main\IO\FileNotFoundException
	 */
	public function getKnownFiles(): array
	{
		$result = [
			$this->getNewsFile(),
			$this->getDetailFile(),
			$this->getSectionFile(),
			$this->getSearchFile(),
			$this->getRssFile(),
			$this->getRssSectionFile(),
		];

		return $result;
	}

	public function getNewsFile(): File
	{
		return FileSystem::getInnerFile($this, 'news.php');
	}

	public function getDetailFile(): File
	{
		return FileSystem::getInnerFile($this, 'detail.php');
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

	public function getInnerTemplatesTrees(): array
	{
		$result = [];
		$innerTemplates = $this->getInnerTemplatesDir();
		if ($innerTemplates->isExists()) {
			foreach ($innerTemplates->getChildren() as $innerComponentDir) {
				if ($innerComponentDir instanceof Directory) {
					foreach ($innerComponentDir->getChildren() as $innerTemplateDir) {
						$result[] = new SimpleComponentTemplate($innerTemplateDir->getPath());
					}
				}
			}
		}

		return $result;
	}

	public function getInnerTemplatesDir(): array
	{
		return [FileSystem::getInnerDirectory($this, 'bitrix')];
	}
}
