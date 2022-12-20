<?php
namespace Intervolga\Edu\Tests\Course2\Lesson2;


use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Mail\Internal\EventMessageTable;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;

class TestPostEvent extends BaseTest
{
	protected static function run(){
		$parameters = static::getPostTemplateParameters();
		Assert::notEmpty($parameters, Loc::getMessage('INTERVOLGA_EDU.POST_EVENT_NOT_FOUND'));

	}
	protected static function getPostTemplateParameters(){
		$filter = ['filter' =>
			['EVENT_NAME' =>
				['CHECK_OLDER_STOCKS','STOCK_ENDED']]

		];
		$parameters = EventMessageTable::getList($filter)->fetch();

		return $parameters;
	}

}