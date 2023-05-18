<?php
namespace Intervolga\Edu\Tests\Course1\Lesson7;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Asserts\AssertComponent;
use Intervolga\Edu\Locator\Component\Template\MenuBottom;
use Intervolga\Edu\Locator\Component\Template\MenuLeft;
use Intervolga\Edu\Locator\Component\Template\MenuTop;
use Intervolga\Edu\Locator\Component\Template\TemplateLocator;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\FileMessage;
use Intervolga\Edu\Util\FileSystem;

class TestMenu extends BaseTest
{
	public static function interceptErrors()
	{
		return true;
	}

	protected static function run()
	{
		AssertComponent::templateLocator(MenuBottom::class);
		AssertComponent::templateLocator(MenuTop::class);
		AssertComponent::templateLocator(MenuLeft::class);
		static::checkCacheParams(MenuBottom::class);
		static::checkCacheParams(MenuTop::class);
		static::checkCacheParams(MenuLeft::class);
	}

	/**
	 * @return string|templateLocator
	 */
	protected static function checkCacheParams($templateLocator)
	{
		if ($component = $templateLocator::find()) {
			$file = FileSystem::getFile($component['REAL_PATH']);
			Assert::eq(
				$component['PARAMETERS']['MENU_CACHE_TYPE'],
				'N',
				Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_7_PARAMETERS_CACHE_TYPE',
					[
						'#COMPONENT#' => $component['COMPONENT_NAME'],
						'#TEMPLATE#' => $component['PARAMETERS']['COMPONENT_TEMPLATE'],
						'#PATH#' => FileMessage::get($file),
					]
				)
			);

			Assert::eq(
				$component['PARAMETERS']['MENU_CACHE_USE_GROUPS'],
				'N',
				Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_7_PARAMETERS_CACHE_GROUPS',
					[
						'#COMPONENT#' => $component['COMPONENT_NAME'],
						'#TEMPLATE#' => $component['PARAMETERS']['COMPONENT_TEMPLATE'],
						'#PATH#' => FileMessage::get($file),
					]
				)
			);
		}
	}
}