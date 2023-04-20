<?php
namespace Intervolga\Edu\FilesTree;

use Bitrix\Main\IO\Directory;
use Intervolga\Edu\Util\FileSystem;

class RespondentsComponentTemplate extends Directory
{
	public function getDefaultTemplatesPath(): Directory
	{
		return FileSystem::getInnerDirectory($this, 'templates/.default');
	}

	public function getInnerPhpFiles()
	{
		$result = [];
		$innerTemplates = $this->getDefaultTemplatesPath();
		if ($innerTemplates->isExists()) {
			foreach ($innerTemplates->getChildren() as $innerComponentFile) {
				if ($innerComponentFile->getExtension() == 'php') {
					$result[] = $innerComponentFile;
				}
			}
		}

		return $result;
	}
}
