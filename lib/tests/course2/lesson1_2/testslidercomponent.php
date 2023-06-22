<?php
namespace Intervolga\Edu\Tests\Course2\Lesson1_2;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Asserts\AssertComponent;
use Intervolga\Edu\FilesTree\ComponentTemplate;
use Intervolga\Edu\FilesTree\SimpleComponentTemplate;
use Intervolga\Edu\Locator\Component\Template\Slider;
use Intervolga\Edu\Locator\IO\ComponentTemplate\SliderTemplate;
use Intervolga\Edu\Tests\BaseComponentTemplateTest;

class TestSliderComponent extends BaseComponentTemplateTest
{
	const SLIDER_PATH = '/local/templates/main/header.php';

	protected static function run()
	{
		$locatorClass = static::getLocator();
		AssertComponent::componentLocator(Slider::class);
		if ($slider = Slider::find()) {
			Assert::eq($slider['REAL_PATH'], static::SLIDER_PATH,
				Loc::getMessage('INTERVOLGA_EDU.COURSE_2.LESSON_1_2.WRONG_PATH_SLIDER',
					['#PATH#' => static::SLIDER_PATH]));
		}

		Assert::directoryLocator($locatorClass);
		if ($templateDir = $locatorClass::find(static::getComponentTemplateTree())) {
			/**
			 * @var ComponentTemplate $templateDir
			 */
			static::testTemplateTrash($templateDir);
			static::testTemplateCode($templateDir);
		}
	}

	protected static function getLocator()
	{
		return SliderTemplate::class;
	}

	protected static function getComponentTemplateTree()
	{
		return SimpleComponentTemplate::class;
	}

	protected static function checkNotExistingFilesTemplate(ComponentTemplate $templateDir)
	{
		Assert::fseNotExists($templateDir->getImagesDir());
		Assert::fseNotExists($templateDir->getDescriptionFile());
	}
}