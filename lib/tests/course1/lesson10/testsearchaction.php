<?php
namespace Intervolga\Edu\Tests\Course1\Lesson10;

use Bitrix\Main\Component\ParametersTable;
use Intervolga\Edu\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\Regex;

class TestSearchAction extends BaseTest
{
	public static function run()
	{
		$getList = ParametersTable::getList([
			'filter' => [
				'=COMPONENT_NAME' => 'bitrix:search.form',
			],
			'select' => [
				'ID',
				'PARAMETERS',
			],
		]);
		$fetch = $getList->fetch();
		$parameters = unserialize($fetch['PARAMETERS']);
		Assert::notMatches(
			$parameters['PAGE'],
			new Regex(
				'/\/index\.php/m',
				'index.php'
			)
		);
	}
}
