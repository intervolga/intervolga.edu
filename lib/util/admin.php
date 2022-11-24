<?php
namespace Intervolga\Edu\Util;

use Bitrix\Main\IO\FileSystemEntry;

class Admin
{
	/**
	 * @param FileSystemEntry $entry
	 * @return string
	 */
	public static function getFileManUrl(FileSystemEntry $entry)
	{
		$url = '';
		$path = FileSystem::getLocalPath($entry);
		if ($entry->isDirectory())
		{
			$url .= '/bitrix/admin/fileman_admin.php';
		}
		else
		{
			$url .= '/bitrix/admin/fileman_file_view.php';
		}
		$url .= '?lang=' . LANGUAGE_ID . '&site=s1&full_src=Y&path='.urlencode($path);

		return $url;
	}
}