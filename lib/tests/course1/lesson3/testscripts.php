<?php
namespace Intervolga\Edu\Tests\Course1\Lesson3;

use Intervolga\Edu\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\FileSystem;
use Intervolga\Edu\Util\Regex;

class TestScripts extends BaseTest
{
	protected static function run()
	{
		$mainHeaderFile = FileSystem::getFile('/local/templates/main/header.php');
		$innerHeaderFile = FileSystem::getFile('/local/templates/inner/header.php');

		$regexes = [
			new Regex('/jquery\.carouFredSel-6\.1\.0-packed\.js/m', 'jquery.carouFredSel-6.1.0-packed.js'),
			new Regex('/slides\.min\.jquery\.js/m', 'slides.min.jquery.js'),
		];

		foreach ($regexes as $regex) {
			Assert::fileContentMatches($mainHeaderFile, $regex);
			Assert::fileContentNotMatches($innerHeaderFile, $regex);
		}
	}
}