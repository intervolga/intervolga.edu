<?php
namespace Intervolga\Edu\Tests\Course3\Lesson3;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Asserts\AssertComponent;
use Intervolga\Edu\FilesTree\ComponentTemplate;
use Intervolga\Edu\Locator\Component\RespondentsComponent;
use Intervolga\Edu\Locator\IO\ComponentTemplate\RespondentsTemplate as IORespondentsTemplate;
use Intervolga\Edu\FilesTree\Component\RespondentsComponent as TreeRespondentsComponent;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\Regex;

class TestTemplateRespondents extends BaseTest
{
	protected static function run()
	{
		AssertComponent::componentLocator(RespondentsComponent::class);
		Assert::directoryLocator(IORespondentsTemplate::class);
		if (IORespondentsTemplate::find()) {
			if ($templateDir = IORespondentsTemplate::find(TreeRespondentsComponent::getTemplateTree())) {
				/**
				 * @var ComponentTemplate $templateDir
				 */
				static::checkFileContent($templateDir);
			}
		}
	}

	protected static function checkFileContent(ComponentTemplate $componentTemplate)
	{
		foreach ($componentTemplate->getChildren() as $child) {
			if ($child->isFile() && $child->getExtension() == 'php') {
				Assert::fileContentNotMatches($child, new Regex('/(Мужчина|Женщина|Заработная плата|Пол|Возраст)/iu',
					Loc::getMessage('INTERVOLGA_EDU.COURSE_3_LESSON_3_FILE_CONTAINS_INVALID_WORLDS')));
			}

		}
	}
}