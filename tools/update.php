<?php
use Bitrix\Main\Application;
require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');
global $USER;
if ($USER->isAdmin()) {
	$currentModuleDirectory = new \Bitrix\Main\IO\Directory(Application::getDocumentRoot() . '/local/modules/intervolga.edu/');

	$directory = new \Bitrix\Main\IO\Directory(Application::getDocumentRoot() . '/local/modules/');
	foreach ($directory->getChildren() as $child) {
		if ($child instanceof \Bitrix\Main\IO\File) {
			if ($child->getExtension() == 'zip') {
				$zip = CBXArchive::getArchive($child->getPath());
				$zip->setOptions([]);
				$path = '/local/modules/tmp_' . time() . '/';
				$result = $zip->unpack(Application::getDocumentRoot() . $path);
				if ($result) {
					$unpacked = new \Bitrix\Main\IO\Directory(Application::getDocumentRoot() . $path);
					foreach ($unpacked->getChildren() as $childInner) {
						$currentModuleDirectory->delete();
						copyDirFiles(
							$childInner->getPath(),
							Application::getDocumentRoot() . '/local/modules/intervolga.edu/',
							true,
							true
						);
					}
					$unpacked->delete();
					$child->delete();
					echo 'OK';
				}
			}
		}
	}
}
require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/epilog_after.php');
