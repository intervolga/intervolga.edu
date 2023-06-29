<?php
namespace Intervolga\Edu\Util;

use Bitrix\Main\Application;
use Bitrix\Main\IO\Directory;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Sniffer;

class StandardsHelper
{
	public static function getStandardsList()
	{
		$result = [];
		$standards = new Directory(Application::getDocumentRoot() . IV_EDU_MODULE_DIR . '/lib/sniffer/standards/');
		foreach ($standards->getChildren() as $child) {
			if ($child->isDirectory()) {
				$result[] = $child->getName();
			}
		}

		return $result;
	}

	public static function getJson($content, $flags)
	{
		$result = [];
		$file = new \Bitrix\Main\IO\File(Application::getDocumentRoot() . IV_EDU_MODULE_DIR . '/lib/checker/temp.php');
		if (!$file->isWritable()) {
			$result = "Не могу произвести запись в файл";
		} else {
			$file->putContents($content);
			foreach ($flags as $flag) {
				$finded = Sniffer::run([$file->getPath()], [$flag]);
				if ($finded) {
					foreach ($finded as $error) {
						$result['items'][$flag][] =
							Loc::getMessage(
								'INTERVOLGA_EDU.STANDARDS_HELPER',
								[
									'#LINE#' => $error->getLine(),
									'#SNIFFER_ERROR#' => $error->getMessage(),
								]
							);
					}
				}
			}
		}
		if (!$result) {
			$result['items']['clear'][] = Loc::getMessage('INTERVOLGA_EDU.ALL_CLEAR');
		}

		return $result;
	}
}