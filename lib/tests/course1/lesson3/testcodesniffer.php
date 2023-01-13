<?php
namespace Intervolga\Edu\Tests\Course1\Lesson3;

use Intervolga\Edu\Tests\BaseTestGoodCode;

class TestCodeSniffer extends BaseTestGoodCode
{
	static function getFilesPaths(): array
	{
		return [
			'/home/bitrix/ext_www/academy-liliya.ivsupport.ru/local/templates/main/header.php',
			'/home/bitrix/ext_www/academy-liliya.ivsupport.ru/local/templates/main/footer.php',
			'/home/bitrix/ext_www/academy-liliya.ivsupport.ru/local/templates/inner/header.php',
			'/home/bitrix/ext_www/academy-liliya.ivsupport.ru/local/templates/inner/footer.php',
		];
	}
}