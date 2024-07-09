<?php

namespace Intervolga\Edu\FilesTree\ComponentTemplate;

use Bitrix\Main\IO\File;
use Intervolga\Edu\FilesTree\SimpleComponentTemplate;
use Intervolga\Edu\Util\FileSystem;

class RespondentsTemplate extends SimpleComponentTemplate
{
	/**
	 * @return File[]
	 * @throws \Bitrix\Main\IO\FileNotFoundException
	 */
	public function getKnownFiles(): array
	{
		$result = [
			$this->getComponentEpilogFile(),
			$this->getParametersFile(),
			$this->getResultModifier(),
			$this->getDescriptionFile(),
			$this->getTemplateFile()
		];
		$result = array_merge($result, $this->getJsFiles());
		$result = array_merge($result, $this->getCssFiles());
		$result = array_merge($result, [
			FileSystem::getInnerFile($this, 'filter.php'),
			FileSystem::getInnerFile($this, 'index.php')
		]);
		$result = array_merge($result, static::getPossibleTemplatesFiles());

		return $result;
	}

	public function getTemplateFile(): File
	{
		return FileSystem::getInnerFile($this, 'respondent.php');
	}

	public function getPossibleTemplatesFiles(): array
	{
		return [
			FileSystem::getInnerFile($this, 'respondent.php'),
			FileSystem::getInnerFile($this, 'respondents.php'),
			FileSystem::getInnerFile($this, 'respondent_send.php'),
			FileSystem::getInnerFile($this, 'respondents_send.php'),
			FileSystem::getInnerFile($this, 'polls_form.php'),
		];
	}
}