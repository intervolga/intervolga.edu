<?php
namespace Intervolga\Edu\Util;

use Bitrix\Main\Loader;

class Menu
{
	/**
	 * @param string $localPath
	 * @param bool $needTrim
	 * @return string[]
	 */
	public static function getMenuLinks(string $localPath, $needTrim = false): array
	{
		$result = [];
		$items = static::getMenuItems($localPath);
		foreach ($items as $menuLink) {
			$key = $menuLink[1];
			if ($needTrim)
			{
				$key = trim($key, '/');
			}
			$result[$key] = $menuLink[0];
		}

		return $result;
	}

	protected static function getMenuItems(string $localPath): array
	{
		$result = [];
		Loader::includeModule('fileman');
		$file = FileSystem::getFile($localPath);
		if ($file->isExists()) {
			$menu = \CFileMan::getMenuArray($file->getPath());
			$result = $menu['aMenuLinks'];
		}

		return $result;
	}
}
