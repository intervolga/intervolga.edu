<?php
namespace Intervolga\Edu\Tests\Course1\Lesson2;

use Intervolga\Edu\Tests\BaseTestCode;
use Intervolga\Edu\Util\FileSystem;

class TestCode extends BaseTestCode
{
	static function getFilesToTestCode(): array
	{
		return [FileSystem::getFile('/local/php_interface/init.php')];
	}
}