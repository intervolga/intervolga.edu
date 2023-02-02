<?php
namespace Intervolga\Edu\FilesTree;

use Bitrix\Main\IO\File;
use Intervolga\Edu\Util\FileSystem;

class CustomVacanciesTemplate extends ComponentTemplate
{
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

	/**
	 * @return File[]
	 * @throws \Bitrix\Main\IO\FileNotFoundException
	 */
	public function getKnownFiles(): array
	{
		$result = parent::getKnownFiles();
		$result[] = $this->getVacanciesFile();
		$result[] = $this->getVacancyFile();
		$result[] = $this->getResumeFile();

		return $result;
	}
}
