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
		$templates = $this->getInnerTemplatesDir();
		foreach ($templates as $template){
			$result[] = $template;
		}

		return $result;
	}

	/**
	 * @return Directory[]
	 */
	abstract public function getInnerTemplatesDir(): array;

	abstract public function getKnownFiles(): array;
}
