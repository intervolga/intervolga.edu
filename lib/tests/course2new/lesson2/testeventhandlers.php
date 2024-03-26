<?php
namespace Intervolga\Edu\Tests\Course2New\Lesson2;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;
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
		static::mainFileCheck();
		static::iblockFileCheck();
	}

	protected static function mainFileCheck()
	{
		$file = FileSystem::getFile('/local/modules/mycompany.custom/lib/eventhandlers/main.php');
		Assert::fseExists($file);
		if (!empty($file->getPath())) {
			Assert::phpSniffer([$file->getPath()], ['eventhandlerClasses']);
			Assert::fileContentMatches($file, new Regex('/redirectFromTestPage/', 'redirectFromTestPage'));
			Assert::fileContentMatches($file, new Regex('/setIsDevServerConstant/', 'setIsDevServerConstant'));
		}
	}

	protected static function iblockFileCheck()
	{
		$file = FileSystem::getFile('/local/modules/mycompany.custom/lib/eventhandlers/iblock.php');
		Assert::fseExists($file);
		if (!empty($file->getPath())) {
			Assert::phpSniffer([$file->getPath()], ['eventhandlerClasses']);
			Assert::fileContentMatches($file, new Regex('/onNewsAdd/', 'onNewsAdd'));
		}
	}
}