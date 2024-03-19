<?php
namespace Intervolga\Edu\Tests\Course2New\Lesson2;

use Bitrix\Main\Application;
use Intervolga\Edu\Sniffer;
use Intervolga\Edu\Tests\BaseTest;

class TestInit extends BaseTest
{
	protected static function run()
	{
		Sniffer::run([Application::getDocumentRoot() . '/bitrix/modules/bitrix.academy/materials/2.2/init.example.php'],
			['initFile']);
	}
}