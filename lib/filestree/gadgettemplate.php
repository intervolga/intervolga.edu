<?php

namespace Intervolga\Edu\FilesTree;

use Bitrix\Main\IO\Directory;

class GadgetTemplate extends SimpleComponentTemplate
{
	public function getKnownFiles(): array
	{
		$result = parent::getKnownFiles();
		$result[] = $this->getResultModifier();
		$result[] = $this->getParametersFile();

		return $result;
	}
	/**
	 * @return Directory[]
	 */
	public function getKnownDirs(): array
	{
		$result = [
			$this->getImagesDir(),
			$this->getLangDir(),
		];

		return $result;
	}
}