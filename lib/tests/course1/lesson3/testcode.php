<?php
namespace Intervolga\Edu\Tests\Course1\Lesson3;

use Intervolga\Edu\Asserts\AssertPhp;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\PathMaskParser;

class TestCode extends BaseTest
{
	public static function interceptErrors()
	{
		return true;
	}

	protected static function run()
	{
		$files = PathMaskParser::getFileSystemEntriesByMasks([
			'/local/templates/main/header.php',
			'/local/templates/main/footer.php',
			'/local/templates/inner/header.php',
			'/local/templates/inner/footer.php',
		]);
		foreach ($files as $file) {
			AssertPhp::goodCode($file);
		}
	}
}