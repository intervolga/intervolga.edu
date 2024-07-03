<?php
namespace Intervolga\Edu\FilesTree\Template;

use Bitrix\Main\IO\File;
use Intervolga\Edu\FilesTree\SimpleComponentTemplate;

class SliderTree extends SimpleComponentTemplate
{
	/**
	 * @return File[]
	 * @throws \Bitrix\Main\IO\FileNotFoundException
	 */
	public function getKnownFiles(): array
	{
		$result = parent::getKnownFiles();
		$result[] = $this->getResultModifier();

		return $result;
	}
}