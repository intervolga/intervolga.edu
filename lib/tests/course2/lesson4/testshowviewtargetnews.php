<?php
namespace Intervolga\Edu\Tests\Course2\Lesson4;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\FileSystem;
use Intervolga\Edu\Util\Regex;

class TestShowViewTargetNews extends BaseTest
{
	protected static function run()
	{
		Assert::fseExists(static::getFilesToTestCode());

		Assert::fileContentMatches(
			static::getFilesToTestCode(),
			new Regex('/<\?(php|=)\s*\$APPLICATION\s*->\s*ShowViewContent\([\w\s<>?=$\[\]\'_"\%\&\;\:\.\(\)]*\)\s*;\s*\?\>[\w\s]*<p\s*class\s*=\s*"\s*title\s*"\s*>/i', Loc::getMessage('INTERVOLGA_EDU.SHOW_VIEW_CONTENT_NOT_FOUND'))
		);

		Assert::fileContentMatches(
			static::getFilesToTestCode(),
			new Regex('/<\?(php|=)\s*\$APPLICATION\s*->\s*ShowViewContent\([\w\s<>?=$\[\]\'_"\%\&\;\:\.\(\)]*news[\w\s<>?=$\[\]\'_"\%\&\;\:\.\(\)]*\)[\w\s<>?=$\[\]\'_"\%\&\;\:\.\(\)]*<p\s*class\s*=\s*"\s*title\s*"\s*>/i', Loc::getMessage('INTERVOLGA_EDU.SHOW_VIEW_CONTENT_NEWS'))
		);
	}

	static function getFilesToTestCode()
	{
		return FileSystem::getFile('/local/templates/inner/header.php');
	}
}