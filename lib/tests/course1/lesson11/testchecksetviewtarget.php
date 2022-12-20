<?php
namespace Intervolga\Edu\Tests\Course1\Lesson11;

use Intervolga\Edu\Tests\BaseTest;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Util\FileSystem;
use Intervolga\Edu\Util\Regex;

class TestCheckSetViewTarget extends BaseTest
{

	static function getFilesToTestCode(): array
	{
		return [FileSystem::getFile('/local/templates/.default/components/bitrix/catalog.element/.default/template.php')];
	}

	protected static function run()
	{
		$files = static::getFilesToTestCode();
		foreach ($files as $file) {
			Assert::fileContentMatches(
				$file,
				new Regex('/\$this\s*->\s*SetViewTarget/i', Loc::getMessage('INTERVOLGA_EDU.SET_VIEW_TARGET'))
			);
		}
	}
}