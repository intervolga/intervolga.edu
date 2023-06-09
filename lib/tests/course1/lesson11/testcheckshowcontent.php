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
		foreach ($files as $file) {
			Assert::fileContentMatches(
				$file,
				new Regex('/\<p\s*class\s*=\s*"\s*title\s*"\s*>[\w,\s\<\?\$\-\>\(\);]*<\/p\>\s*\<\?(php|=)\s*\$APPLICATION\-\>ShowViewContent/i', Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_11_SHOW_VIEW_CONTENT'))
			);

			Assert::fileContentMatches(
				$file,
				new Regex('/\<p\s*class\s*=\s*"\s*title\s*"\s*>[\w,\s\<\?\$\-\>\(\);]*<\/p\>\s*\<\?(php|=)\s*\$APPLICATION\-\>ShowViewContent\((\'|")[\w\s]*(rating|vote)/i', Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_11_SHOW_VIEW_CONTENT_RATING'))
			);
		}
	}
}