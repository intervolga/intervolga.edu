<?php
namespace Intervolga\Edu\Util;

use Bitrix\Main\IO\Directory;
use Bitrix\Main\IO\File;

class StructureService
{
	public static function getPageProperties(File $directoryPage)
	{
		return ParseFileContent($directoryPage->getContents())['PROPERTIES'];
	}

	public static function getDirProperties(Directory $directory)
	{
		global $APPLICATION;
		$result = $APPLICATION->GetDirPropertyList(
			'/' . $directory->getName() . '/'
		);

		return $result;
	}

}