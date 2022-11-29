<?php
namespace Intervolga\Edu\Tests\Course1\Lesson6;

use Bitrix\Main\Application;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Tests\BaseTestIblock;
use Intervolga\Edu\Util\AdminFormOptions;
use Intervolga\Edu\Util\Param;
use Intervolga\Edu\Util\Registry\IblockPropertyRegistry;
use Intervolga\Edu\Util\Registry\IblocksRegistry;

class TestPromoIblock extends BaseTestIblock
{
	const COUNT_PROMO_ELEMENTS = 2;

	public static function run()
	{
		Loader::includeModule('iblock');
		$iblock = IblocksRegistry::getPromoIblock();
		static::registerErrorIfIblockLost(
			$iblock,
			Loc::getMessage('INTERVOLGA_EDU.IBLOCK_PROMO'),
			implode(', ', IblocksRegistry::PROMO_POSSIBLE_CODES)
		);
		if ($iblock) {
			$options = AdminFormOptions::getFormOptionsForIblock($iblock['ID']);
			static::commonChecks($iblock, $options, static::COUNT_PROMO_ELEMENTS);
			static::checkFields($iblock);
			static::checkPriceProperty($iblock);
		}
	}

	protected static function checkFields(array $iblock)
	{
		Loc::loadMessages(Application::getDocumentRoot() . '/bitrix/modules/iblock/admin/iblock_edit.php');
		$fields = \CIBlock::getFields($iblock['ID']);
		$params = [
			new Param(
				Loc::getMessage('IBLOCK_FIELD_ACTIVE_FROM') . ' (' . Loc::getMessage('IB_E_PROP_REQIRED_SHORT') . ')',
				$fields['ACTIVE_FROM']['IS_REQUIRED'],
				'Y'
			),
			new Param(
				Loc::getMessage('IBLOCK_FIELD_ACTIVE_FROM') . ' (' . Loc::getMessage('IB_E_FIELD_DEFAULT_VALUE') . ')',
				$fields['ACTIVE_FROM']['DEFAULT_VALUE'],
				'=today'
			),
			new Param(
				Loc::getMessage('IBLOCK_FIELD_ACTIVE_TO') . ' (' . Loc::getMessage('IB_E_PROP_REQIRED_SHORT') . ')',
				$fields['ACTIVE_TO']['IS_REQUIRED'],
				'N'
			),
			new Param(
				Loc::getMessage('IBLOCK_FIELD_ACTIVE_TO') . ' (' . Loc::getMessage('IB_E_FIELD_DEFAULT_VALUE') . ')',
				$fields['ACTIVE_TO']['DEFAULT_VALUE'],
				'21'
			),
			new Param(
				Loc::getMessage('IBLOCK_FIELD_PREVIEW_TEXT') . ' (' . Loc::getMessage('IB_E_PROP_REQIRED_SHORT') . ')',
				$fields['PREVIEW_TEXT']['IS_REQUIRED'],
				'Y'
			),
			new Param(
				Loc::getMessage('IBLOCK_FIELD_DETAIL_PICTURE') . ' (' . Loc::getMessage('IB_E_PROP_REQIRED_SHORT') . ')',
				$fields['DETAIL_PICTURE']['IS_REQUIRED'],
				'Y'
			),
			new Param(
				Loc::getMessage('IBLOCK_FIELD_PREVIEW_PICTURE') . ' (' . Loc::getMessage('IB_E_FIELD_PREVIEW_PICTURE_FROM_DETAIL') . ')',
				$fields['PREVIEW_PICTURE']['DEFAULT_VALUE']['FROM_DETAIL'],
				'Y'
			),
			new Param(
				Loc::getMessage('IBLOCK_FIELD_PREVIEW_PICTURE') . ' (' . Loc::getMessage('IB_E_FIELD_PICTURE_WIDTH') . ')',
				$fields['PREVIEW_PICTURE']['DEFAULT_VALUE']['WIDTH'],
				80
			),
		];
		static::registerErrorIfIblockParamCheckFailed($params, $iblock);
	}

	protected static function checkPriceProperty(array $iblock)
	{
		$property = IblockPropertyRegistry::getPriceProperty($iblock);
		static::registerErrorIfIblockPropertyLost(
			$iblock,
			$property,
			Loc::getMessage('INTERVOLGA_EDU.PRICE_PROPERTY'),
			implode(', ', IblockPropertyRegistry::PRICE_POSSIBLE_CODES)
		);
	}
}