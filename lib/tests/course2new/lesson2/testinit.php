<?php
namespace Intervolga\Edu\Tests\Course2New\Lesson2;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\FileMessage;
use Intervolga\Edu\Util\FileSystem;
use Intervolga\Edu\Util\Regex;

class TestInit extends BaseTest
{
	public static function interceptErrors()
	{
		return true;
	}

	protected static function run()
	{
		$initFile = FileSystem::getFile('/local/php_interface/init.php');
		$exampleFile = FileSystem::getFile('/local/php_interface/init.example.php');

		Assert::fseNotExists($exampleFile,
			Loc::getMessage('IV_EDU.NEW_ACADEMY.C_2.L_2.INIT_EXAMPLE',
				['#FILE#' => FileMessage::get($exampleFile)]));
		Assert::fseExists($initFile);
		Assert::fileContentMatches($initFile, new Regex('/Loader::includeModule\((\'|\")mycompany\.custom/',
			Loc::getMessage('IV_EDU.NEW_ACADEMY.C_2.L_2.INIT_CUSTOM_MODULE')));

		Assert::phpSniffer([$initFile->getPath()], ['initFile']);
	}
}