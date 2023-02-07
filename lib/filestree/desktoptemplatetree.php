<?php
namespace Intervolga\Edu\FilesTree;

use Bitrix\Main\IO\Directory;

class DesktopTemplateTree extends SimpleComponentTemplate
{
	public function getKnownFiles(): array
	{
		$result = parent::getKnownFiles();
		$result[] = $this->getResultModifier();

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