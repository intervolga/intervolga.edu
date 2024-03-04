<?php
namespace Intervolga\Edu\Util;

use Bitrix\Main\Application;

class Backup
{
	public static function get()
	{
		include Application::getDocumentRoot() . '/bitrix/modules/main/classes/general/backup.php';
		$arTmpFiles = array_merge(static::getLocalBackup(), static::getCloudBackup());

		return static::prepareOutput($arTmpFiles);
	}

	public static function getLocalBackup()
	{
		$arTmpFiles = [];

		if (is_dir($p = Application::getDocumentRoot() . BX_ROOT . '/backup')) {
			if ($dir = opendir($p)) {
				while (($item = readdir($dir)) !== false) {
					$f = $p . '/' . $item;
					if (!is_file($f)) {
						continue;
					}
					$arTmpFiles[] = [
						'NAME' => $item,
						'SIZE' => filesize($f),
						'DATE' => filemtime($f),
						'BUCKET_ID' => 0,
						'PLACE' => "LOCAL"
					];
				}
				closedir($dir);
			}
		}

		return $arTmpFiles;
	}

	public static function getCloudBackup()
	{
		$arAllBucket = \CBackup::GetBucketList();
		$arTmpFiles = [];
		if ($arAllBucket) {
			foreach ($arAllBucket as $arBucket) {
				if ($arCloudFiles = \CBackup::GetBucketFileList($arBucket['ID'], BX_ROOT . '/backup/')) {
					foreach ($arCloudFiles['file'] as $k => $v) {
						$arTmpFiles[] = [
							'NAME' => $v,
							'SIZE' => $arCloudFiles['file_size'][$k],
							'DATE' => preg_match('#^([0-9]{4})([0-9]{2})([0-9]{2})_([0-9]{2})([0-9]{2})([0-9]{2})#', $v, $r) ? strtotime("{$r[1]}-{$r[2]}-{$r[3]} {$r[4]}:{$r[5]}:{$r[6]}") : '',
							'BUCKET_ID' => $arBucket['ID'],
							'PLACE' => 'BUCKET'
						];
					}
				}
			}
		}

		return $arTmpFiles;
	}

	public static function prepareOutput($arTmpFiles)
	{
		$arFiles = [];
		$arParts = [];
		$arSize = [];
		$i = 0;

		foreach ($arTmpFiles as $k => $ar) {
			if (preg_match('#^(.*\.(enc|tar|gz|sql))(\.[0-9]+)?$#', $ar['NAME'], $regs)) {
				$i++;
				$BUCKET_ID = intval($ar['BUCKET_ID']);
				$arParts[$BUCKET_ID . $regs[1]]++;
				$arSize[$BUCKET_ID . $regs[1]] += $ar['SIZE'];

				if (!$regs[3]) {
					$key = $regs[1];
					$key .= '_' . $i;
					$arFiles[$key] = $ar;
				}
			}
		}
		krsort($arFiles);

		return $arFiles;
	}
}