<?php
namespace Intervolga\Edu\Tests\Course1\Lesson9;

use Intervolga\Edu\Asserts\AssertComponent;
use Intervolga\Edu\Locator\Component\Catalog;
use Intervolga\Edu\Tests\BaseTest;

class TestComponentOptions extends BaseTest
{
	public static function interceptErrors()
	{
		return true;
	}

	protected static function run()
	{
		AssertComponent::componentLocator(Catalog::class);

		AssertComponent::parameterEq(
			Catalog::class,
			'SEF_MODE',
			'Y'
		);
		AssertComponent::parameterEq(
			Catalog::class,
			'SEF_FOLDER',
			'/products/'
		);
		AssertComponent::parameterEq(
			Catalog::class,
			'SEF_URL_TEMPLATES.sections',
			''
		);
		AssertComponent::parameterEq(
			Catalog::class,
			'SEF_URL_TEMPLATES.section',
			'#SECTION_CODE#/'
		);
		AssertComponent::parameterEq(
			Catalog::class,
			'SEF_URL_TEMPLATES.element',
			'#SECTION_CODE#/#ELEMENT_CODE#/'
		);
		AssertComponent::parameterEq(
			Catalog::class,
			'SEF_URL_TEMPLATES.compare',
			''
		);
	}
}