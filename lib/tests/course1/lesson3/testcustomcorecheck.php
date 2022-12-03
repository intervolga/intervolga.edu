<?php
namespace Intervolga\Edu\Tests\Course1\Lesson3;

use Bitrix\Main\IO\File;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\PathMaskParser;
use Intervolga\Edu\Util\Registry\RegexRegistry;

class TestCustomCoreCheck extends BaseTest
{
	protected static function run()
	{
		$files = static::getLessonFilesToCheck();
		$regexes = RegexRegistry::getCustomCore();
		foreach ($files as $file) {
			foreach ($regexes as $regex) {
				/**
				 * @var File $file
				 */
				Assert::fileContentMatches($file, $regex);
			}
		}
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