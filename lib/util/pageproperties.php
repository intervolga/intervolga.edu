<?php
namespace Intervolga\Edu\Util;

use Bitrix\Main\IO\Directory;
use Bitrix\Main\IO\File;

class PageProperties
{
	public static function GetPageProperties(File $directoryPage)
	{
		return ParseFileContent($directoryPage->getContents())['PROPERTIES'];
	}

	public static function GetDirProperties(Directory $directory)
	{
		$result = (new \CMain)->GetDirPropertyList(
			'/' . $directory->getName() . '/'
		);

		return $result;
	}

}