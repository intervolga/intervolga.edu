<?php
namespace Intervolga\Edu\FilesTree\Template;

use Bitrix\Main\IO\Directory;
use Bitrix\Main\IO\FileNotFoundException;
use Intervolga\Edu\FilesTree\SimpleComponentTemplate;
use Intervolga\Edu\Util\FileSystem;

class BottomMenuTree extends SimpleComponentTemplate
{
	/**
	 * @return Directory[]
	 * @throws FileNotFoundException
	 */
	public function getLangForeignDirs(): array
	{
		$result = [];
		$langDirectory = $this->getLangDir();
		if ($langDirectory->isExists()) {
			foreach ($langDirectory->getChildren() as $item) {
				if ($item->getName() != ('ru'||'en')) {
					$result[] = $item;
				}
			}
		}
		return $result;
	}
	public function getLangEnDir(): Directory
	{
		$langDirectory = $this->getLangDir();

		return FileSystem::getInnerDirectory($langDirectory, 'en');
	}
}