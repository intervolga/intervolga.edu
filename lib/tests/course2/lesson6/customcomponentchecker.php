<?php

namespace Intervolga\Edu\Tests\Course2\Lesson6;

use Bitrix\Main\Component\ParametersTable;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Asserts\AssertComponent;
use Intervolga\Edu\FilesTree\ComponentTemplate;
use Intervolga\Edu\FilesTree\CustomVacanciesTree;
use Intervolga\Edu\Locator\Component\CustomVacancies;
use Intervolga\Edu\Locator\IO\ComponentTemplate\CustomVacanciesTemplate;
use Intervolga\Edu\Locator\IO\DirectoryLocator;
use Intervolga\Edu\Tests\BaseComplexComponentTemplateTest;
use Intervolga\Edu\Tests\BaseComponentTemplateTest;
use Intervolga\Edu\Tests\BaseComponentTest;
use Intervolga\Edu\Tests\BaseTest;

class CustomComponentChecker extends BaseComponentTest
{
// сделать локатор для кастомного компонента - чтобы найти, стащить параметры
	//найти вызов компонента - find вроде должен как раз это чекать
	//проверить вызов на странице ассертом?
	protected static function run()
	{

		//\Bitrix\Main\Diag\Debug::dump(CustomVacancies::getCode());
		AssertComponent::componentLocator(CustomVacancies::class);
		\Bitrix\Main\Diag\Debug::dump(static::getLocator()::find(static::getComponentTemplateTree()));
		if ($templateDir = static::getLocator()::find(static::getComponentTemplateTree())) {
			/**
			 * @var ComponentTemplate $templateDir
			 */
			static::testTemplateTrash($templateDir);
			static::testTemplateCode($templateDir);
		}
		parent::run();

		/*if(CustomVacancies::find()){

		}*/

	}



	/**
	 * @return string|DirectoryLocator
	 */
	protected static function getLocator()
	{

	}
	/**
	 * @return string|ComponentTemplate
	 */
	protected static function getComponentTemplateTree()
	{
		return CustomVacanciesTree::class;
	}

	protected static function getTemplateLocator()
	{
		return CustomVacanciesTemplate::class;
	}
}