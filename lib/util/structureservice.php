<?php
namespace Intervolga\Edu\Util;

use Bitrix\Main\IO\Directory;
use Bitrix\Main\IO\File;

class StructureService
{
	public static function getPageProperties(File $directoryPage)
	{
		$return = [];
		$properties = parseFileContent($directoryPage->getContents())['PROPERTIES'];
		foreach ($properties as $name => $value) {
			$return[strtoupper($name)] = $value;
		}

		return $return;
	}

	public static function getDirProperties(Directory $directory)
	{
		global $APPLICATION;
		$result = $APPLICATION->getDirPropertyList(
			'/' . $directory->getName() . '/'
		);

		return $result;
	}
}