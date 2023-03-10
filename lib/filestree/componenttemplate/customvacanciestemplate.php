<?php
namespace Intervolga\Edu\FilesTree\ComponentTemplate;

use Bitrix\Main\IO\Directory;
use Bitrix\Main\IO\File;
use Intervolga\Edu\FilesTree\ComplexComponentTemplate;
use Intervolga\Edu\FilesTree\SimpleComponentTemplate;
use Intervolga\Edu\Util\FileSystem;

class CustomVacanciesTemplate extends ComplexComponentTemplate
{
	/**
	 * @return File[]
	 * @throws \Bitrix\Main\IO\FileNotFoundException
	 */
	public function getKnownFiles(): array
	{
		$result = [
			$this->getVacanciesFile(),
			$this->getVacancyFile(),
			$this->getResumeFile(),
		];

		return $result;
	}

	public function getVacanciesFile(): File
	{
		return FileSystem::getInnerFile($this, 'vacancies.php');
	}

	public function getVacancyFile(): File
	{
		return FileSystem::getInnerFile($this, 'vacancy.php');
	}

	public function getResumeFile(): File
	{
		return FileSystem::getInnerFile($this, 'resume.php');
	}

	public function getInnerTemplatesTrees(): array
	{
		$result = [];
		$innerTemplates = static::getInnerTemplatesDir();
		foreach ($innerTemplates as $innerTemplate){
			if ($innerTemplate->isExists()) {
				foreach ($innerTemplate->getChildren() as $innerTemplateDir) {
					if ($innerTemplateDir instanceof Directory) {
						$result[] = new SimpleComponentTemplate($innerTemplateDir->getPath());
					}
				}
			}
		}

		return $result;
	}

	/**
	 * @return Directory[]
	 */
	public function getInnerTemplatesDir(): array
	{
		return [
			FileSystem::getInnerDirectory($this, 'templates/.default/intervolga/'),
			FileSystem::getInnerDirectory($this, 'templates/.default/bitrix/'),
		];
	}
}
