<?php
namespace Intervolga\Edu\Util;

use Bitrix\Main\Application;
use Bitrix\Main\IO\Directory;
use Bitrix\Main\IO\File;
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

	public static function getJson($contentType, $content, $flags)
	{
		switch ($contentType) {
			case 'code':
				return static::getFromCode($content, $flags);
			case 'file':
				return static::getFromFile($content, $flags);
			case 'folder':
				return static::getFromFolder($content, $flags);
			default:
				return ['items' => ['clear' => ['clearCode' => [Loc::getMessage('INTERVOLGA_EDU.ALL_CLEAR')]]]];
		}
	}

	public static function getFromCode($content, $flags): array
	{
		$result = [];
		$file = new File(Application::getDocumentRoot() . IV_EDU_MODULE_DIR . '/lib/checker/temp.php');
		if (!$file->isWritable()) {
			$result['items']['code']['error'][] = "Не могу произвести запись в файл";
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
			$result['items']['code']['clear'][] = Loc::getMessage('INTERVOLGA_EDU.ALL_CLEAR');
		}

		return $result;
	}

	public static function getFromFile($content, $flags): array
	{
		$result = [];
		$file = new File(Application::getDocumentRoot() . $content);
		if (!$file->isExists()) {
			$result['items'][$content]['error'][] = "Не могу найти файл (проверьте путь)";
		} else {
			foreach ($flags as $flag) {
				$finded = Sniffer::run([$file->getPath()], [$flag]);
				if ($finded) {
					foreach ($finded as $error) {
						$result['items'][$file->getName()][$flag][] =
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
			$result['items'][$file->getName()]['clear'][] = Loc::getMessage('INTERVOLGA_EDU.ALL_CLEAR');
		}

		return $result;
	}

	public static function getFromFolder($content, $flags): array
	{
		$result = [];
		$directory = new Directory(Application::getDocumentRoot() . $content);
		if (!$directory->isExists()) {
			$result['items'][$content]['error'][] = "Не могу найти директорию (проверьте путь)";
		} else {
			foreach ($directory->getChildren() as $child) {
				if ($child->isFile()) {
					foreach ($flags as $flag) {
						$finded = Sniffer::run([$child->getPath()], [$flag]);
						if ($finded) {
							foreach ($finded as $error) {
								$result['items'][$child->getName()][$flag][] =
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
			}
		}
		if (!$result) {
			$result['items'][$directory->getName()]['clear'][] = Loc::getMessage('INTERVOLGA_EDU.ALL_CLEAR');
		}

		return $result;

	}
}