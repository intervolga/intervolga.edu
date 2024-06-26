<?php
namespace Intervolga\Edu\Tests\Course1\Lesson10;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Asserts\AssertComponent;
use Intervolga\Edu\Locator\Component\SearchForm;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\ComponentParameters;
use Intervolga\Edu\Util\Regex;

class TestSearchAction extends BaseTest
{
	protected static function run()
	{
		AssertComponent::componentLocator(SearchForm::class);
		$parameters = SearchForm::find()['PARAMETERS'];
		Assert::notEmpty($parameters['PAGE']);
		Assert::notMatches(
			$parameters['PAGE'],
			new Regex(
				'/\/index\.php/m',
				'index.php'
			)
		);
	}
}
