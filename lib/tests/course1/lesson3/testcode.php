<?php
namespace Intervolga\Edu\Tests\Course1\Lesson3;

use Intervolga\Edu\Tests\BaseTestCode;
use Intervolga\Edu\Util\PathMaskParser;

class TestCode extends BaseTestCode
{
	static function getFilesToTestCode(): array
	{
		return PathMaskParser::getFileSystemEntriesByMasks([
			'/local/templates/main/header.php',
			'/local/templates/main/footer.php',
			'/local/templates/inner/header.php',
			'/local/templates/inner/footer.php',
		]);
	}
}