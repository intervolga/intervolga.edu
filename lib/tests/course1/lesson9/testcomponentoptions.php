<?php
namespace Intervolga\Edu\Tests\Course1\Lesson9;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Asserts\AssertComponent;
use Intervolga\Edu\Locator\Component\Catalog;
use Intervolga\Edu\Locator\Component\ComponentLocator;
use Intervolga\Edu\Tests\BaseTest;

class TestComponentOptions extends BaseTest
{
	protected static function run()
	{
		AssertComponent::componentLocator(static::getLocator());
		$parameters = static::getLocator()::find()['PARAMETERS'];

		Assert::eq($parameters['SEF_MODE'], 'Y', Loc::getMessage('INTERVOLGA_EDU.SEF_MODE'));
		Assert::eq($parameters['SEF_FOLDER'], '/products/', Loc::getMessage('INTERVOLGA_EDU.SEF_FOLDER'));
		Assert::eq($parameters['SEF_URL_TEMPLATES']['sections'], '', Loc::getMessage('INTERVOLGA_EDU.SEF_URL_TEMPLATES_SECTIONS'));
		Assert::eq($parameters['SEF_URL_TEMPLATES']['section'], '#SECTION_CODE#/', Loc::getMessage('INTERVOLGA_EDU.SEF_URL_TEMPLATES_SECTION'));
		Assert::eq($parameters['SEF_URL_TEMPLATES']['element'], '#SECTION_CODE#/#ELEMENT_CODE#/', Loc::getMessage('INTERVOLGA_EDU.SEF_URL_TEMPLATES_ELEMENT'));
		Assert::eq($parameters['SEF_URL_TEMPLATES']['compare'], '', Loc::getMessage('INTERVOLGA_EDU.SEF_URL_TEMPLATES_COMPARE'));

	}

	/**@return string|ComponentLocator
	 **/
	protected static function getLocator()
	{
		return Catalog::class;
	}
}