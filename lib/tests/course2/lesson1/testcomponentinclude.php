<?php

namespace Intervolga\Edu\Tests\Course2\Lesson1;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\IO\FileLocator;
use Intervolga\Edu\Locator\IO\MainHeaderTemplate;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\Regex;

class TestComponentInclude extends BaseTest
{
	protected static function run()
	{
		Assert::fseExists(static::getLocator()::find());
		Assert::fileContentMatches(static::getLocator()::find(), new Regex('/\$APPLICATION-\>IncludeComponent\(\s*(\'|")bitrix\:news\.list(\'|")\,\s*(\'|")slider(\'|")/i', Loc::getMessage('MAIN_HEADER_TEMPLATE_INCLUDE_COMPONENT')));
	}

	/**
	 * @return string|FileLocator
	 */
	protected static function getLocator(){
		return MainHeaderTemplate::class;
	}

}