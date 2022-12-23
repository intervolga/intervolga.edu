<?php
namespace Intervolga\Edu\Tests\Course1\Lesson7;

use Intervolga\Edu\Locator\Component\Template\LatestStock;
use Intervolga\Edu\Locator\Component\Template\TemplateLocator;
use Intervolga\Edu\Tests\BaseTestTemplateParameters;

class TestLatestStock extends BaseTestTemplateParameters
{
	/**
	 * @return string|TemplateLocator
	 */
	protected static function getLocator()
	{
		return LatestStock::class;
	}
}