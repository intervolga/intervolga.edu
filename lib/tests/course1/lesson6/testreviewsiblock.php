<?php
namespace Intervolga\Edu\Tests\Course1\Lesson6;

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Tests\BaseTestIblock;
use Intervolga\Edu\Util\Admin;
use Intervolga\Edu\Util\AdminFormOptions;
use Intervolga\Edu\Util\Registry\Iblock\Property\CompanyProperty;
use Intervolga\Edu\Util\Registry\Iblock\Property\PostProperty;
use Intervolga\Edu\Util\Registry\Iblock\ReviewsIblock;

class TestReviewsIblock extends BaseTestIblock
{
	const COUNT_REVIEWS_ELEMENTS = 6;

	public static function run()
	{
		Loader::includeModule('iblock');
		static::registerErrorIfIblockLost(ReviewsIblock::class);
		if ($iblock = ReviewsIblock::find()) {
			$options = AdminFormOptions::getFormOptionsForIblock($iblock['ID']);
			static::commonChecks($iblock, $options, static::COUNT_REVIEWS_ELEMENTS);
			static::checkPostAndCompanyProperties();
			if ($options) {
				static::checkRenamedSurname($iblock, $options);
			}
		}
	}

	protected static function checkRenamedSurname(array $iblock, array $options)
	{
		foreach ($options['TABS'] as $tab) {
			if (mb_strlen($tab['FIELDS']['NAME'])) {
				if ($tab['FIELDS']['NAME'] != Loc::getMessage('INTERVOLGA_EDU.FIELD_SURNAME')) {
					static::registerError(Loc::getMessage('INTERVOLGA_EDU.RENAME_FIELD_NAME', [
						'#IBLOCK_LINK#' => Admin::getIblockElementAddUrl($iblock),
						'#IBLOCK#' => $iblock['NAME'],
						'#RENAME#' => Loc::getMessage('INTERVOLGA_EDU.FIELD_SURNAME'),
					]));
				}
			}
		}
	}

	protected static function checkPostAndCompanyProperties()
	{
		static::registerErrorIfIblockPropertyLost(PostProperty::class);
		static::registerErrorIfIblockPropertyLost(CompanyProperty::class);
	}
}