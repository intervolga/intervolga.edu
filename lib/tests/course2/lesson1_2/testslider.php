<?php
namespace Intervolga\Edu\Tests\Course2\Lesson1_2;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\FilesTree\ComponentTemplate;
use Intervolga\Edu\FilesTree\SimpleComponentTemplate;
use Intervolga\Edu\Locator\IO\DirectoryLocator;
use Intervolga\Edu\Locator\IO\SliderStockTemplate;
use Intervolga\Edu\Tests\BaseTest;
use Bitrix\Main\IO\Directory;
use Intervolga\Edu\Exceptions\AssertException;
use Intervolga\Edu\Locator\IO\ComponentTemplate\SliderTemplate;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\Regex;

class TestSlider extends BaseTest
{
	const REG_TITLE_IMG = '/<img[\w\s<>?=$[\]\'\"%&;:\.()]*title[\w\s<>?=$[\]\'"%&;:\.()]*\/>/is';
	const REG_TITLE = '/<a[\w\s<>?=$[\]\'"%&;:\.()]*title[\w\s<>?=$[\]\'"%&;:\.()]*>[\w\s<>?=$[\]\'"%&;:\.()]*(подробнее|Loc::getMessage)[\w\s<>?=$[\]\'"%&;:\.()]*\/a>/ius';
	const REG_BINDING_VALUE_IMG = '/<img[\w\s<>?=$[\]\'"]*href\s*=\s*"[\/]+[\w\s<>?=$[\]\'"\/]*"[\w\s<>?=$[\]\'"%&;:]*>/is';
	const REG_BINDING_VALUE = '/<a[\w\s<>?=$[\]\'"]*href\s*=\s*"[\/]+[\w\s<>?=$[\]\'"\/]*"[\w\s<>?=$[\]\'"%&;:]*>/is';

	public static function interceptErrors()
	{
		return true;
	}

	protected static function run()
	{
		Assert::directoryLocator(SliderTemplate::class);
		if ($directory = SliderTemplate::find()) {
			static::testTemplate($directory);
			static::testComponentEpilogFile($directory);
      static::testResultModifier($directory);
		}
	}

	/**
	 * @throws AssertException
	 */
	protected static function testTemplate(Directory $directory)
	{
		$file = FileSystem::getInnerFile($directory, 'template.php');
		Assert::fseExists($file);
		if ($file->isExists()) {
			Assert::fileContentMatches($file, new Regex(static::REG_TITLE_IMG,
				Loc::getMessage('INTERVOLGA_EDU.COURSE_2.LESSON_1_2.NOT_TITLE_IN_LINK_IMG')));
			Assert::fileContentMatches($file, new Regex(static::REG_TITLE,
				Loc::getMessage('INTERVOLGA_EDU.COURSE_2.LESSON_1_2.NOT_TITLE_IN_LINK')));

			Assert::fileContentNotMatches($file, new Regex(static::REG_BINDING_VALUE_IMG,
				Loc::getMessage('INTERVOLGA_EDU.COURSE_2.LESSON_1_2.LINK_SET_NOT_BINDING_VALUE_IMG')));
			Assert::fileContentNotMatches($file, new Regex(static::REG_BINDING_VALUE,
				Loc::getMessage('INTERVOLGA_EDU.COURSE_2.LESSON_1_2.LINK_SET_NOT_BINDING_VALUE')));
		}
	}

	/**
	 * @throws AssertException
	 */
	protected static function testComponentEpilogFile(Directory $directory)
	{
		$file = FileSystem::getInnerFile($directory, 'component_epilog.php');
		Assert::fseExists($file);
		if ($file->isExists()) {
			Assert::fileContentMatches($file, new Regex('/slides\.min\.jquery\.js/is',
				Loc::getMessage('INTERVOLGA_EDU.COURSE_2.LESSON_1_2.JS_NOT_FOUND_IN_COMPONENT_EPILOG')));
		}
	}
  protected static function testResultModifier(Directory $directory)
	{
    $file = FileSystem::getInnerFile($directory, 'result_modifier.php');
		Assert::fseExists($file);
    if($file->isExists()){
      Assert::fileContentMatches($file, new Regex('/CFile::ResizeImageGet/i', 
        Loc::getMessage('INTERVOLGA_EDU.NOT_FOUND_RESIZE')));
    }
  }
}