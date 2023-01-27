<?php
namespace Intervolga\Edu\Tests\Course2\Lesson5_1;

use Bitrix\Main\IO\File;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\IO\CustomComponent;
use Intervolga\Edu\Locator\IO\DirectoryLocator;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\FileSystem;
use Intervolga\Edu\Util\Regex;

class TestDescription extends BaseTest
{
	public static function interceptErrors()
	{
		return true;
	}

	protected static function run()
	{
		Assert::directoryLocator(static::getLocator());
		if (static::getLocator()::find()) {
			Assert::fseExists(static::getDescriptionFile());
			if (static::getDescriptionFile()->isExists()) {
				Assert::fileContentNotMatches(
					static::getDescriptionFile(),
					new Regex('/[а-яё]+/iu', Loc::getMessage('INTERVOLGA_EDU.FOUND_RU_WORDS'))
				);
				Assert::fileContentNotMatches(
					static::getDescriptionFile(),
					new Regex('/news_list.gif/iu', Loc::getMessage('INTERVOLGA_EDU.FOUND_GIF_NEWS'))
				);
			}
		}
	}

	/**
	 * @return string|DirectoryLocator
	 */
	protected static function getLocator()
	{
		return CustomComponent::class;
	}

	/**
	 * @return File|null
	 */
	protected static function getDescriptionFile(): File
	{
		return FileSystem::getInnerFile(static::getLocator()::find(), '.description.php');
	}
}