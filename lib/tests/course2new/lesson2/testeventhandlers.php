<?php
namespace Intervolga\Edu\Tests\Course2New\Lesson2;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\FileMessage;
use Intervolga\Edu\Util\FileSystem;
use Intervolga\Edu\Util\Regex;

class TestEventhandlers extends BaseTest
{
	public static function interceptErrors()
	{
		return true;
	}

	protected static function run()
	{
		static::fileSniffCheck(['main', 'iblock']);
	}

	protected static function fileSniffCheck(array $fileNames)
	{
		$paths = [];
		foreach ($fileNames as $fileName){
			$file = FileSystem::getFile('/local/modules/mycompany.custom/lib/eventhandlers/' . $fileName . '.php');
			Assert::fseExists($file);
			$paths[] = $file->getPath();
		}
		if (!empty($paths)){
			Assert::phpSniffer($paths, ['eventhandlerClasses']);
		}
	}
}