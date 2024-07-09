<?php
namespace Intervolga\Edu\Tests\Course3\Lesson3;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\FilesTree\ComponentTemplate;
use Intervolga\Edu\FilesTree\ComponentTemplate\RespondentsTemplate as TreeRespondentTemplate;
use Intervolga\Edu\Locator\IO\ComponentTemplate\RespondentTemplate as IORespondentTemplate;
use Intervolga\Edu\Tests\BaseComponentTemplateTest;

class TestRespondentComponentTemplate extends BaseComponentTemplateTest
{
	protected static function getLocator()
	{
		return IORespondentTemplate::class;
	}

	protected static function getComponentTemplateTree()
	{
		return TreeRespondentTemplate::class;
	}

	protected static function checkRequiredFilesTemplate(ComponentTemplate $templateDir)
	{
		$count = 0;
		$possibleNames = [];
		foreach ($templateDir->getPossibleTemplatesFiles() as $knownPhpFile) {
			$possibleNames[] = $knownPhpFile->getName();
			if ($knownPhpFile->isExists()) {
				$count++;
			}
		}
		Assert::greaterEq($count, 2,
			Loc::getMessage('INTERVOLGA_EDU.COURSE_3_LESSON_3_POSSIBLE_TEMPLATE_NAMES',
				[
					'#POSSIBLE_NAMES#' => implode(' | ', $possibleNames),
				]
			));
	}
}