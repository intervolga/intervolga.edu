<?php
namespace Intervolga\Edu\Tests\Course2\Lesson3;

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use CIBlockElement;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\Iblock\NewsIblock;
use Intervolga\Edu\Tests\BaseTest;

class DeactivationNotActiveNews extends BaseTest
{
	protected static function run()
	{
		Loader::includeModule('iblock');

		$news = new  CIBlockElement;
		$idIblock = $news->Add([
			"ACTIVE" => 'N',
			"NAME" => 'Новый тестовый неактивный инфоблок',
			"CODE" => 'new_test_iblock',
			"IBLOCK_ID" => NewsIblock::find()['ID'],
		]);
		Assert::notEmpty($idIblock, Loc::getMessage('INTERVOLGA_EDU.COURSE2_LESSON3_CREATE_NOT_ACTIVE_IB_FAILED'));

		$deactivNews = $news->Update(
			$idIblock, [
			"ACTIVE" => 'N',
		]);

		CIBlockElement::Delete($idIblock);

		Assert::true($deactivNews, Loc::getMessage('INTERVOLGA_EDU.COURSE2_LESSON3_NOT_ACTIVE_NEWS_DEACTIVATED'));

	}
}