<?php
namespace Intervolga\Edu\Tests\Course1\Lesson6;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\Iblock\IblockLocator;
use Intervolga\Edu\Locator\Iblock\Property\CompanyProperty;
use Intervolga\Edu\Locator\Iblock\Property\PostProperty;
use Intervolga\Edu\Locator\Iblock\Property\PropertyLocator;
use Intervolga\Edu\Locator\Iblock\ReviewsIblock;
use Intervolga\Edu\Tests\BaseTestIblock;
use Intervolga\Edu\Util\AdminFormOptions;

class TestReviewsIblock extends BaseTestIblock
{
	/**
	 * @return string|IblockLocator
	 */
	protected static function getLocator()
	{
		return ReviewsIblock::class;
	}

	protected static function getMinCount(): int
	{
		return 6;
	}

	/**
	 * @return PropertyLocator[]
	 */
	protected static function getPropertiesLocators(): array
	{
		return [
			PostProperty::class,
			CompanyProperty::class
		];
	}

	protected static function run()
	{
		parent::run();
		if ($iblock = static::getLocator()::find()) {
			$options = AdminFormOptions::getForIblock($iblock['ID']);
			static::testRenamedSurname($options);
		}
	}

	protected static function testRenamedSurname(array $options)
	{
		foreach ($options['TABS'] as $tab) {
			if (mb_strlen($tab['FIELDS']['NAME'])) {
				Assert::eq(
					$tab['FIELDS']['NAME'],
					Loc::getMessage('INTERVOLGA_EDU.FIELD_SURNAME'),
					Loc::getMessage('INTERVOLGA_EDU.RENAME_FIELD_NAME')
				);
			}
			if (mb_strlen($tab['FIELDS']['PREVIEW_PICTURE'])) {
				Assert::eq(
					$tab['FIELDS']['PREVIEW_PICTURE'],
					Loc::getMessage('INTERVOLGA_EDU.FIELD_PREVIEW_PICTURE'),
					Loc::getMessage('INTERVOLGA_EDU.RENAME_FIELD_NAME')
				);
			}
			if (mb_strlen($tab['FIELDS']['PREVIEW_TEXT'])) {
				Assert::eq(
					$tab['FIELDS']['PREVIEW_TEXT'],
					Loc::getMessage('INTERVOLGA_EDU.FIELD_PREVIEW_TEXT'),
					Loc::getMessage('INTERVOLGA_EDU.RENAME_FIELD_NAME')
				);
			}
		}
	}
}