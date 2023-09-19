<?php
namespace Intervolga\Edu\Tests\Course2\Lesson1_2;

use Intervolga\Edu\Asserts\AssertComponent;
use Intervolga\Edu\Locator\Component\Template\Slider;
use Intervolga\Edu\Locator\Component\Template\TemplateLocator;
use Intervolga\Edu\Tests\BaseTest;

class TestComponentInclude extends BaseTest
{
	protected static function run()
	{
		AssertComponent::TemplateLocator(static::getLocator());
	}

	/**
	 * @return string|TemplateLocator
	 */
	protected static function getLocator()
	{
		return Slider::class;
	}

}