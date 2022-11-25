<?php
namespace Intervolga\Edu\Tests\Course1\Lesson10;

use Bitrix\Main\Component\ParametersTable;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Util\BaseTest;

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
		if ($fetch = $getList->fetch()) {
			if ($fetch['PARAMETERS']) {
				$parameters = unserialize($fetch['PARAMETERS']);
				if (mb_substr_count($parameters['PAGE'], '/index.php'))
				{
					static::registerError(Loc::getMessage('INTERVOLGA_EDU.SEARCH_FORM_ACTION_HAS_INDEX_PHP'));
				}
			}
		}
	}
}
