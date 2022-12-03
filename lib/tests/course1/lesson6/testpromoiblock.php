<?php
namespace Intervolga\Edu\Tests\Course1\Lesson6;

use Bitrix\Main\Application;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTestIblock;
use Intervolga\Edu\Util\AdminFormOptions;
use Intervolga\Edu\Util\Registry\Iblock\PromoIblock;
use Intervolga\Edu\Util\Registry\Iblock\Property\PriceProperty;

class TestPromoIblock extends BaseTestIblock
{
	const COUNT_PROMO_ELEMENTS = 2;

	protected static function run()
	{
		Assert::registryIblock(PromoIblock::class);
		if ($iblock = PromoIblock::find()) {
			$options = AdminFormOptions::getFormOptionsForIblock($iblock['ID']);
			static::commonChecks($iblock, $options, static::COUNT_PROMO_ELEMENTS);
			static::checkFields($iblock);
			Assert::registryProperty(PriceProperty::class);
		}
	}

	protected static function checkFields(array $iblock)
	{
		Loc::loadMessages(Application::getDocumentRoot() . '/bitrix/modules/iblock/admin/iblock_edit.php');
		$fields = \CIBlock::getFields($iblock['ID']);
		Assert::eq(
			$fields['ACTIVE_FROM']['IS_REQUIRED'],
			'Y',
			static::getMessageForIblockFieldParam('ACTIVE_FROM', 'IS_REQUIRED', 'Y')
		);
		Assert::eq(
			$fields['ACTIVE_FROM']['DEFAULT_VALUE'],
			'=today',
			static::getMessageForIblockFieldParam('ACTIVE_FROM', 'DEFAULT_VALUE', Loc::getMessage('IB_E_FIELD_ACTIVE_FROM_TODAY'))
		);
		Assert::eq(
			$fields['ACTIVE_TO']['IS_REQUIRED'],
			'N',
			static::getMessageForIblockFieldParam('ACTIVE_TO', 'IS_REQUIRED', 'N')
		);
		Assert::eq(
			$fields['ACTIVE_TO']['DEFAULT_VALUE'],
			'21',
			static::getMessageForIblockFieldParam('ACTIVE_TO', 'DEFAULT_VALUE', '21')
		);
		Assert::eq(
			$fields['PREVIEW_TEXT']['IS_REQUIRED'],
			'Y',
			static::getMessageForIblockFieldParam('PREVIEW_TEXT', 'IS_REQUIRED', 'Y')
		);
		Assert::eq(
			$fields['DETAIL_PICTURE']['IS_REQUIRED'],
			'Y',
			static::getMessageForIblockFieldParam('DETAIL_PICTURE', 'IS_REQUIRED', 'Y')
		);
		Assert::eq(
			$fields['PREVIEW_PICTURE']['DEFAULT_VALUE']['FROM_DETAIL'],
			'Y',
			static::getMessageForIblockFieldParam('PREVIEW_PICTURE', 'FROM_DETAIL', 'Y')
		);
		Assert::eq(
			$fields['PREVIEW_PICTURE']['DEFAULT_VALUE']['WIDTH'],
			80,
			static::getMessageForIblockFieldParam('PREVIEW_PICTURE', 'WIDTH', 'Y')
		);
	}

	protected static function getMessageForIblockFieldParam(string $field, string $param, $expect): string
	{
		$codes = [
			'IS_REQUIRED' => Loc::getMessage('IB_E_PROP_REQIRED_SHORT'),
			'DEFAULT_VALUE' => Loc::getMessage('IB_E_FIELD_DEFAULT_VALUE'),
			'FROM_DETAIL' => Loc::getMessage('IB_E_FIELD_PREVIEW_PICTURE_FROM_DETAIL'),
			'WIDTH' => Loc::getMessage('IB_E_FIELD_PICTURE_WIDTH'),
		];

		return Loc::getMessage('INTERVOLGA_EDU.IBLOCK_FIELD_PARAM_SHOULD_BE_SET', [
			'#FIELD#' => Loc::getMessage('IBLOCK_FIELD_' . $field),
			'#PARAM#' => $codes[$param],
			'#EXPECT#' => $expect
		]);
	}
}