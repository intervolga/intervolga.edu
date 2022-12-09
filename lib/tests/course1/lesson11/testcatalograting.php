<?php
namespace Intervolga\Edu\Tests\Course1\Lesson11;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\ComponentParameters;

class TestCatalogRating extends BaseTest
{
	protected static function run()
	{
		$parameters = ComponentParameters::getComponentParameters('bitrix:catalog');
		Assert::eq(
			$parameters['DETAIL_USE_VOTE_RATING'],
			'Y'
		);
	}
}