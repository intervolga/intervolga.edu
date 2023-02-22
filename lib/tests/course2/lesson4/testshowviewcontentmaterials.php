<?php

namespace Intervolga\Edu\Tests\Course2\Lesson4;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\FileSystem;
use Intervolga\Edu\Util\Regex;

class TestShowViewContentMaterials extends BaseTest
{
	protected static function run()
	{
		Assert::fseExists(static::getFilesToTestCode());

		Assert::fileContentMatches(
			static::getFilesToTestCode(),
			new Regex('/\$APPLICATION\s*->\s*ShowViewContent/i', Loc::getMessage('INTERVOLGA_EDU.SHOW_VIEW_CONTENT_NOT_FOUND_MATERIALS'))
		);

	}

	static function getFilesToTestCode()
	{
		return FileSystem::getFile('/local/templates/inner/footer.php');
	}

}