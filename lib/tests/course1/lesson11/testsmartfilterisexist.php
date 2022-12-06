<?php
namespace Intervolga\Edu\Tests\Course1\Lesson11;
use Bitrix\Main\Component\ParametersTable;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;


class TestSmartFilterIsExist extends BaseTest
{
	protected static function run()
	{
		$getList = ParametersTable::getList([
			'filter' => [
				'=COMPONENT_NAME' => 'bitrix:catalog',
			],
			'select' => [
				'ID',
				'PARAMETERS',
			],
		]);
		$fetch = $getList->fetch();
		$parameters = unserialize($fetch['PARAMETERS']);
		Assert::eq(
			$parameters['USE_FILTER'],
			'Y'
		);
	}
}