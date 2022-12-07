<?php
namespace Intervolga\Edu\Tests\Course1\Lesson10;

use Bitrix\Main\Component\ParametersTable;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\ComponentParameters;
use Intervolga\Edu\Util\Regex;

class TestSearchAction extends BaseTest
{
	protected static function run()
	{
		$parameters = ComponentParameters::getComponentParameters('bitrix:search.form');
		
		Assert::notMatches(
			$parameters['PAGE'],
			new Regex(
				'/\/index\.php/m',
				'index.php'
			)
		);
	}
}
