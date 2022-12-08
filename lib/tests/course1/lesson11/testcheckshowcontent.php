<?php

namespace Intervolga\Edu\Tests\Course1\Lesson11;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\FileSystem;
use Intervolga\Edu\Util\Regex;

class TestCheckShowContent extends BaseTest
{
	static function getFilesToTestCode(): array
	{
		return [FileSystem::getFile('/local/templates/inner/header.php')];
	}

	protected static function run()
	{
		$files = static::getFilesToTestCode();
		foreach ($files as $file)
			Assert::fileContentMatches(
				$file,
				new Regex('/\<div\s*class\s*=\s*\"\s*main_title\s*\">\s*\<\?(php\s*|=\s*)\$APPLICATION\s*->\s*ShowViewContent/i', Loc::getMessage('INTERVOLGA_EDU.SHOW_VIEW_CONTENT'))
			);
	}
}