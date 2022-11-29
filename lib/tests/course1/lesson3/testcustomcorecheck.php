<?php
namespace Intervolga\Edu\Tests\Course1\Lesson3;

use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\PathMaskParser;
use Intervolga\Edu\Util\Registry\RegexRegistry;

class TestCustomCoreCheck extends BaseTest
{
	public static function run()
	{
		$files = static::getLessonFilesToCheck();
		$regexes = RegexRegistry::getCustomCore();
		static::registerErrorIfFileContentNotFoundByRegex($files, $regexes);
	}

	/**
	 * @return \Bitrix\Main\IO\FileSystemEntry[]
	 */
	public static function getLessonFilesToCheck(): array
	{
		$result = PathMaskParser::getFileSystemEntriesByMasks([
			'/local/templates/main/header.php',
			'/local/templates/main/footer.php',
			'/local/templates/inner/header.php',
			'/local/templates/inner/footer.php',
		]);

		return $result;
	}
}