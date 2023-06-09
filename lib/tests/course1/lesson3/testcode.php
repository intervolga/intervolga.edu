<?php
namespace Intervolga\Edu\Tests\Course1\Lesson3;

use Bitrix\Main\Application;
use Intervolga\Edu\Tests\BaseTestCode;

class TestCode extends BaseTestCode
{
	static function getFilesPaths(): array
	{
		return [
			Application::getDocumentRoot().'/local/templates/main/header.php',
			Application::getDocumentRoot().'/local/templates/main/footer.php',
			Application::getDocumentRoot().'/local/templates/inner/header.php',
			Application::getDocumentRoot().'/local/templates/inner/footer.php',
		];
	}
}