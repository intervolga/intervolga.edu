<?php
namespace Intervolga\Edu\Util;

use Bitrix\Main\Application;
use Bitrix\Main\IO\Directory;
use Bitrix\Main\IO\File;

class Update
{
	/**
	 * @return Directory
	 */
	public static function getModuleDir()
	{
		return new Directory(Application::getDocumentRoot() . '/local/modules/intervolga.edu/');
	}

	/**
	 * @return File[]
	 * @throws \Bitrix\Main\IO\FileNotFoundException
	 */
	public static function getZipFiles()
	{
		$result = [];
		$directory = new Directory(Application::getDocumentRoot() . '/local/modules/');
		foreach ($directory->getChildren() as $child) {
			if ($child instanceof File) {
				if ($child->getExtension() == 'zip') {
					$result[] = $child;
				}
			}
		}

		return $result;
	}

	/**
	 * @param string $name
	 * @throws \Bitrix\Main\IO\FileNotFoundException
	 */
	public static function unpack($name)
	{
		$file = new File(Application::getDocumentRoot() . '/local/modules/' . $name);
		if ($file->isExists()) {
			$zip = \CBXArchive::getArchive($file->getPath());
			$path = '/local/modules/tmp_' . time() . '/';
			$result = $zip->unpack(Application::getDocumentRoot() . $path);
			if ($result) {
				$unpacked = new Directory(Application::getDocumentRoot() . $path);
				foreach ($unpacked->getChildren() as $childInner) {
					static::getModuleDir()->delete();
					copyDirFiles(
						$childInner->getPath(),
						Application::getDocumentRoot() . '/local/modules/intervolga.edu/',
						true,
						true
					);
				}
				$unpacked->delete();
				$file->delete();
			}
		}
	}
}
