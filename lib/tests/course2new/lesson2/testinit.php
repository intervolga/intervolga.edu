<?php
namespace Intervolga\Edu\Tests\Course2New\Lesson2;

use Bitrix\Main\Application;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;

class TestInit extends BaseTest
{
	public static function interceptErrors()
	{
		return true;
	}

	protected static function run()
	{
		Assert::phpSniffer(
			[Application::getDocumentRoot() . '/bitrix/modules/bitrix.academy/materials/2.2/init.example.php'],
			['initFile']);
	}
}