<?php
namespace Intervolga\Edu\Tests\Course2\Lesson3;

use Bitrix\Main\EventManager;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;

class HandlersChecker extends BaseTest
{
	protected static function run()
	{
		$event = EventManager::getInstance()
			->findEventHandlers('iblock', 'OnBeforeIBlockElementUpdate', ['FROM_MODULE_ID' => ''])
		;
		Assert::notEmpty($event, Loc::getMessage('INTERVOLGA_EDU.COURSE2_LESSON3_NOT_FOUND_EVENTHANDLER'));
	}

}