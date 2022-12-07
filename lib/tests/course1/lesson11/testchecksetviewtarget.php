<?php

namespace Intervolga\Edu\Tests\Course1\Lesson11;

use Bitrix\Catalog\v2\Tests\BaseTest;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Asserts\AssertPhp;
use Intervolga\Edu\Tests\BaseTestCode;
use Intervolga\Edu\Util\FileSystem;
use Intervolga\Edu\Util\Regex;

class TestCheckSetViewTarget extends BaseTestCode
{
	
	static function getFilesToTestCode(): array
	{
		return [FileSystem::getFile('/local/templates/.default/components/bitrix/catalog.element/.default/template.php')];
	}
	
	protected static function run()
	{
		$files = static::getFilesToTestCode();
		foreach ($files as $file)
		Assert::fileContentMatches(
			$file,
			new Regex('/\$this->SetViewTarget/i', Loc::getMessage('INTERVOLGA_EDU.SET_VIEW_TARGET'))
		);
	}
}