<?php
namespace Intervolga\Edu\Tests\Course2New\Lesson2;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\FileSystem;
use Intervolga\Edu\Util\Regex;

class TestFunctionsAndConstants extends BaseTest
{
	protected static function run()
	{
		static::checkFunctionFile();
		static::checkConstantFile();
	}

	protected static function checkFunctionFile()
	{
		$funcFile = FileSystem::getFile('/local/modules/mycompany.custom/functions.php');
		Assert::fseExists($funcFile);
		if ($funcFile->isExists()) {
			Assert::fileContentMatches($funcFile, new Regex('/is404Page/', 'функция is404Page'));
		}
	}

	protected static function checkConstantFile()
	{
		$constFile = FileSystem::getFile('/local/modules/mycompany.custom/constants.php');
		Assert::fseExists($constFile);
		if ($constFile->isExists()) {
			Assert::fileContentMatches($constFile, new Regex('/IBLOCK_NEWS_ID/', 'константа IBLOCK_NEWS_ID'));
			Assert::fileContentMatches($constFile, new Regex('/IBLOCK_NEWS_ID/', 'константа IBLOCK_CATALOG_PROPERTY_PRICE_ID'));
		}
	}
}