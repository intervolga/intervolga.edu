<?php
namespace Intervolga\Edu\Tests\Course2\Lesson1;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\FilesTree\ComponentTemplate;
use Intervolga\Edu\FilesTree\SimpleComponentTemplate;
use Intervolga\Edu\Locator\IO\DirectoryLocator;
use Intervolga\Edu\Locator\IO\SliderStockTemplate;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\Regex;

class TestSlider extends BaseTest
{
	protected static function run()
	{

		/**
		 * @var ComponentTemplate $templateDir
		 */
		$templateDir = static::getLocator()::find(static::getComponentTemplateTree());
		Assert::fseExists(static::getLocator()::find());

		Assert::fseExists($templateDir->getTemplateFile());
		static::testTemplate($templateDir);
		Assert::fseExists($templateDir->getResultModifier());
		static::testResultModifier($templateDir);
		Assert::fseExists($templateDir->getComponentEpilogFile());
		static::testComponentEpilogFile($templateDir);

	}

	/**
	 * @return string|DirectoryLocator
	 */
	protected static function getLocator()
	{
		return SliderStockTemplate::class;
	}

	/**
	 * @return string|ComponentTemplate
	 */
	protected static function getComponentTemplateTree()
	{
		return SimpleComponentTemplate::class;
	}

	protected static function testTemplate(ComponentTemplate $templateDir)
	{
		Assert::fseExists(static::getLocator()::find());

		Assert::fileContentMatches($templateDir->getTemplateFile(), new Regex('/<img[\w\s<>?=$\[\]\'"\%\&\;\:\.\(\)]*title[\w\s<>?=$\[\]\'"\%\&\;\:\.\(\)]*\/>/is', Loc::getMessage('INTERVOLGA_EDU.NOT_TITLE_IN_LINK_IMG')));
		Assert::fileContentMatches($templateDir->getTemplateFile(), new Regex('/<a[\w\s<>?=$\[\]\'"\%\&\;\:\.\(\)]*title[\w\s<>?=$\[\]\'"\%\&\;\:\.\(\)]*>[\w\s<>?=$\[\]\'"\%\&\;\:\.\(\)]*(подробнее|Loc::getMessage)[\w\s<>?=$\[\]\'"\%\&\;\:\.\(\)]*\/a>/ius', Loc::getMessage('INTERVOLGA_EDU.NOT_TITLE_IN_LINK')));

		Assert::fileContentNotMatches($templateDir->getTemplateFile(), new Regex('/<img[\w\s<>?=$\[\]\'"]*href\s*=\s*"[\/]+[\w\s<>?=$\[\]\'"\/]*"[\w\s<>?=$\[\]\'"\%\&\;\:]*>/is', Loc::getMessage('INTERVOLGA_EDU.LINK_SET_NOT_BINDING_VALUE_IMG')));
		Assert::fileContentNotMatches($templateDir->getTemplateFile(), new Regex('/<a[\w\s<>?=$\[\]\'"]*href\s*=\s*"[\/]+[\w\s<>?=$\[\]\'"\/]*"[\w\s<>?=$\[\]\'"\%\&\;\:]*>/is', Loc::getMessage('INTERVOLGA_EDU.LINK_SET_NOT_BINDING_VALUE')));

	}

	protected static function testResultModifier(ComponentTemplate $templateDir)
	{
		Assert::fileContentMatches($templateDir->getResultModifier(), new Regex('/CFile::ResizeImageGet/i', Loc::getMessage('INTERVOLGA_EDU.NOT_FOUND_RESIZE')));
		Assert::fileContentNotMatches($templateDir->getResultModifier(), new Regex('/(foreach|while|for)[\w\s<>?=$\[\]\'"\%\&\;\:\(\)]*{[\w\s<>?=$\[\]\'"\%\&\;\:\(\)]*CIBlockElement::GetList/is', Loc::getMessage('INTERVOLGA_EDU.GET_LIST_IN_FOREACH')));

	}

	protected static function testComponentEpilogFile(ComponentTemplate $templateDir) {
		Assert::fileContentMatches($templateDir->getComponentEpilogFile(), new Regex('/->\s*addJs\s*\([\w\s<>?=$\[\]\'"\%\&\;\:\.\(\)]*\/js\/slides\.min\.jquery\.js/is', Loc::getMessage('INTERVOLGA_EDU.JS_NOT_FOUND_IN_COMPONENT_EPILOG')));

	}

}