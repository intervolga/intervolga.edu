<?php
namespace Intervolga\Edu\Util;

use Bitrix\Main\IO\FileSystemEntry;

class Admin
{
	/**
	 * @param FileSystemEntry $entry
	 * @return string
	 */
	public static function getEditUrl(FileSystemEntry $entry)
	{
		$path = FileSystem::getLocalPath($entry);
		return '/bitrix/admin/fileman_file_edit.php?lang=' . LANGUAGE_ID . '&site=s1&full_src=Y&path='.urlencode($path);
	}
}