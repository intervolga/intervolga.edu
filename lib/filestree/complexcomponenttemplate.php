<?php
namespace Intervolga\Edu\FilesTree;

use Bitrix\Main\IO\Directory;
use Intervolga\Edu\Util\FileSystem;

class ComplexComponentTemplate extends ComponentTemplate
{
	public function getInnerTemplatesDir(): Directory
	{
		return FileSystem::getInnerDirectory($this, 'bitrix');
	}

	/**
	 * @return SimpleComponentTemplate[]
	 * @throws \Bitrix\Main\IO\FileNotFoundException
	 */
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

	/**
	 * @return Directory[]
	 */
	public function getKnownDirs(): array
	{
		$result = parent::getKnownDirs();
		$result[] = $this->getInnerTemplatesDir();

		return $result;
	}
}
