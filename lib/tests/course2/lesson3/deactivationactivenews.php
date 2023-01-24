<?php
namespace Intervolga\Edu\Tests\Course2\Lesson3;

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use CIBlockElement;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\Iblock\NewsIblock;
use Intervolga\Edu\Tests\BaseTest;

class DeactivationActiveNews extends BaseTest
{
	protected static function run()
	{
		global $APPLICATION;
		Loader::includeModule('iblock');

		$news = new  CIBlockElement;
		$idIblock = $news->Add([
			"ACTIVE" => 'Y',
			"NAME" => 'Новый тестовый инфоблок',
			"CODE" => 'new_test_iblock',
			"IBLOCK_ID" => NewsIblock::find()['ID'],
		]);
		Assert::notEmpty($idIblock, Loc::getMessage('INTERVOLGA_EDU.COURSE2_LESSON3_CREATE_IB_FAILED'));

		$deactivNews = $news->Update(
			$idIblock, [
			"ACTIVE" => 'N',
		]);
		Assert::false($deactivNews, Loc::getMessage('INTERVOLGA_EDU.COURSE2_LESSON3_NEWS_DEACTIVATED'));

		if($ex = $APPLICATION->GetException()) {
			$strError = $ex->GetString();
		}
		CIBlockElement::Delete($idIblock);
		Assert::notEq($strError, 'Unknown error', Loc::getMessage('INTERVOLGA_EDU.COURSE2_LESSON3_NOT_FOUND_EXCEPTION'));

	}
}