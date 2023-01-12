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

	public static function getIblockUrl(array $iblock): string
	{
		$url = '/bitrix/admin/iblock_edit.php?type=' . urlencode($iblock['IBLOCK_TYPE_ID']) . '&lang=' . LANGUAGE_ID . '&ID=' . $iblock['ID'];
		return $url;
	}

	public static function getIblockElementsUrl(array $iblock): string
	{
		$url = '/bitrix/admin/iblock_element_admin.php?IBLOCK_ID=' . $iblock['ID'] . '&type=' . urlencode($iblock['IBLOCK_TYPE_ID']) . '&lang=' . LANGUAGE_ID . '&apply_filter=Y';
		return $url;
	}

	public static function getIblockElementAddUrl(array $iblock): string
	{
		$url = '/bitrix/admin/iblock_element_edit.php?IBLOCK_ID=' . $iblock['ID'] . '&type=' . urlencode($iblock['IBLOCK_TYPE_ID']) . '&lang=' . LANGUAGE_ID . '&ID=0&find_section_section=-1&IBLOCK_SECTION_ID=-1';
		return $url;
	}

	/**
	 * @param array $agent
	 * @return string
	 */
	public static function getAgentUrl(array $agent)
	{
		return '/bitrix/admin/agent_edit.php?ID= ' . $agent['ID'] . '&lang=' . LANGUAGE_ID;
	}

	/**
	 * @param array $section
	 * @return string
	 */
	public static function getIblockSectionUrl(array $section)
	{
		$url = '/bitrix/admin/iblock_section_edit.php?IBLOCK_ID=' . $section['IBLOCK_ID'] . '&lang=' . LANGUAGE_ID . '&ID=' . $section['ID'] . '&find_section_section=0&from=iblock_section_admin';
		return $url;
	}

	/**
	 * @param array $section
	 * @return string
	 */
	public static function getEventMessageUrl(array $eventTemplate)
	{
		$url = '/bitrix/admin/message_edit.php?lang=' . LANGUAGE_ID . '&ID=' . $eventTemplate['ID'];
		return $url;
	}

	/**
	 * @param array $eventMessage
	 * @return string
	 */
	public static function getEventTypeUrl(array $eventMessage)
	{
		$url = '/bitrix/admin/type_edit.php?EVENT_NAME=' . $eventMessage['EVENT_NAME'];
		return $url;
	}
}