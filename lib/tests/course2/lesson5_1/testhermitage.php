<?php
namespace Intervolga\Edu\Tests\Course2\Lesson5_1;

use Bitrix\Main\IO\File;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\IO\CustomComponentTemplate;
use Intervolga\Edu\Locator\IO\DirectoryLocator;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\FileSystem;
use Intervolga\Edu\Util\Regex;

class TestHermitage extends BaseTest
{
	protected static function run()
	{
		Assert::directoryLocator(static::getLocator());
		Assert::fseExists(static::getTemplateFile());
		Assert::fileContentMatches(
			static::getTemplateFile(),
			new Regex('/\$this->AddEditAction[\w\d\s\(\)\$[\]\'",:;\-\><=?\/]*\$this->AddEditAction/i', Loc::getMessage('INTERVOLGA_EDU.NOT_FOUND_HERMITAGE'))
		);
	}

	/**
	 * @return string|DirectoryLocator
	 */
	protected static function getLocator()
	{
		return CustomComponentTemplate::class;
	}

	/**
	 * @return File|null
	 */
	protected static function getTemplateFile(): File
	{
		return FileSystem::getInnerFile(static::getLocator()::find(), 'template.php');
	}
}