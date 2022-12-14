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
				new Regex('/<p\s*class\s*=\s*"\s*title\s*"\s*>\s*.*<\/p>\s*<\?(php|=)\s*\$APPLICATION\s*->\s*ShowViewContent/i', Loc::getMessage('INTERVOLGA_EDU.SHOW_VIEW_CONTENT'))
			);
		Assert::fileContentMatches(
			$file,
			new Regex('/<p\s*class\s*=\s*"\s*title\s*"\s*>\s*.*<\/p>\s*<\?(php|=)\s*\$APPLICATION\s*->\s*ShowViewContent\(.*rating.*/i', Loc::getMessage('INTERVOLGA_EDU.SHOW_VIEW_CONTENT_RATING'))
		);
	}
}