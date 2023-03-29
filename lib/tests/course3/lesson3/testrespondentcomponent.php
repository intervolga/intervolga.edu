<?php
namespace Intervolga\Edu\Tests\Course3\Lesson3;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Asserts\AssertComponent;
use Intervolga\Edu\FilesTree\Component\Component;
use Intervolga\Edu\FilesTree\Component\SimpleComponent;
use Intervolga\Edu\FilesTree\ComponentTemplate;
use Intervolga\Edu\FilesTree\FilesTree;
use Intervolga\Edu\Locator\Component\RespondentsComponent;
use Intervolga\Edu\Locator\IO\ComponentTemplate\RespondentsTemplate;
use Intervolga\Edu\Locator\IO\CustomRespondents;
use Intervolga\Edu\Locator\IO\DirectoryLocator;
use Intervolga\Edu\Tests\BaseComponentTest;
use Intervolga\Edu\Util\Regex;

class TestRespondentComponent extends BaseComponentTest
{
	protected static function run()
	{
		AssertComponent::componentLocator(RespondentsComponent::class);
		if (RespondentsComponent::find()) {
			parent::run();
		}
	}

	protected static function checkTemplateDirectory()
	{
		$locatorTemplate = static::getTemplateLocator();
		Assert::directoryLocator($locatorTemplate);
		if ($templateDir = $locatorTemplate::find(static::getComponentTemplateTree()::getTemplateTree())) {
			/**
			 * @var ComponentTemplate $templateDir
			 */
			static::testTemplateCode($templateDir);
			static::checkFileContent($templateDir);
		}
	}

	/**
	 * @return string|DirectoryLocator
	 */
	protected static function getTemplateLocator()
	{
		return RespondentsTemplate::class;
	}

	/**
	 * @return string|Component
	 */
	protected static function getComponentTemplateTree()
	{
		return SimpleComponent::class;
	}

	protected static function testTemplateCode(FilesTree $templateDir)
	{
		$files = [];
		foreach ($templateDir->getChildren() as $file) {
			if ($file->isFile() && $file->getExtension() == 'php') {
				$files[] = $file->getPath();
			}
		}
		Assert::phpSniffer($files, [
			'general',
		]);
	}

	protected static function checkFileContent(ComponentTemplate $templateDir)
	{
		foreach ($templateDir->getChildren() as $child) {
			if ($child->isFile() && $child->getExtension() == 'php') {
				Assert::fileContentNotMatches($child, new Regex('/(Мужчина|Женщина|Заработная плата|Пол|Возраст)/iu',
					Loc::getMessage('INTERVOLGA_EDU.COURSE_3_LESSON_3_FILE_CONTAINS_INVALID_WORLDS')));
			}
			//todo: lang-папку проверить
		}
	}

	/**
	 * @return string|DirectoryLocator
	 */
	protected static function getLocator()
	{
		return CustomRespondents::class;
	}
}