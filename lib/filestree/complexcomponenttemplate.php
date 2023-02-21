<?php
namespace Intervolga\Edu\FilesTree;

use Bitrix\Main\IO\Directory;

abstract class ComplexComponentTemplate extends ComponentTemplate
{
	/**
	 * @return SimpleComponentTemplate[]
	 * @throws \Bitrix\Main\IO\FileNotFoundException
	 */
	abstract public function getInnerTemplatesTrees(): array;

	/**
	 * @return Directory[]
	 */
	public function getKnownDirs(): array
	{
		$result = parent::getKnownDirs();
		$result[] = $this->getInnerTemplatesDir();

		return $result;
	}

	abstract public function getInnerTemplatesDir(): Directory;

	abstract public function getKnownFiles(): array;
}
