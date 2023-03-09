<?php
namespace Intervolga\Edu\FilesTree\ComponentTemplate;

use Bitrix\Main\IO\Directory;
use Bitrix\Main\IO\File;
use Intervolga\Edu\FilesTree\ComplexComponentTemplate;
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
		$innerTemplates = $this->getInnerTemplatesDir();
		if ($innerTemplates->isExists()) {
			foreach ($innerTemplates->getChildren() as $innerTemplateDir) {
				if ($innerTemplateDir instanceof Directory) {
					$result[] = new SimpleComponentTemplate($innerTemplateDir->getPath());
				}
			}
		}

		return $result;
	}

	public function getInnerTemplatesDir(): Directory
	{
		return FileSystem::getInnerDirectory($this, 'templates');
	}
}
