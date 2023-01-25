<?php
namespace Intervolga\Edu\Tests\Course1\Lesson2;

use Bitrix\Main\Application;
use Intervolga\Edu\Tests\BaseTestCode;

class TestCode extends BaseTestCode
{
	static function getFilesPaths(): array
	{
		return [Application::getDocumentRoot().'/local/php_interface/init.php'];
	}
}