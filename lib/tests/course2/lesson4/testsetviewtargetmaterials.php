<?php

namespace Intervolga\Edu\Tests\Course2\Lesson4;

use Bitrix\Main\IO\File;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\IO\ComponentTemplate\CatalogSectionTemplate;
use Intervolga\Edu\Locator\IO\DirectoryLocator;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\Regex;

class TestSetViewTargetMaterials extends BaseTest
{
	protected static function run()
	{
		Assert::directoryLocator(static::getDirectoryLocator());
		Assert::fseExists(static::getTemplateFile());
		Assert::fileContentMatches(
			static::getTemplateFile(),
			new Regex('/\$this\s*->\s*SetViewTarget/i', Loc::getMessage('INTERVOLGA_EDU.SET_VIEW_TARGET'))
		);

	}

	/**
	 * @return string|DirectoryLocator
	 */
	static function getDirectoryLocator()
	{
		return CatalogSectionTemplate::class;
	}

	static function getTemplateFile()
	{
		return new File(static::getDirectoryLocator()::find()->getPhysicalPath() . '/template.php');
	}


}