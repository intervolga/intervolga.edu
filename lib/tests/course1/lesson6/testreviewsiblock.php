<?php
namespace Intervolga\Edu\Tests\Course1\Lesson6;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Assert;
use Intervolga\Edu\Tests\BaseTestIblock;
use Intervolga\Edu\Util\AdminFormOptions;
use Intervolga\Edu\Util\Registry\Iblock\Property\CompanyProperty;
use Intervolga\Edu\Util\Registry\Iblock\Property\PostProperty;
use Intervolga\Edu\Util\Registry\Iblock\ReviewsIblock;

class TestReviewsIblock extends BaseTestIblock
{
	const COUNT_REVIEWS_ELEMENTS = 6;

	protected static function run()
	{
		Assert::registryIblock(ReviewsIblock::class);
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
				Assert::eq(
					$tab['FIELDS']['NAME'],
					Loc::getMessage('INTERVOLGA_EDU.FIELD_SURNAME'),
					Loc::getMessage('INTERVOLGA_EDU.RENAME_FIELD_NAME')
				);
			}
		}
	}

	protected static function checkPostAndCompanyProperties()
	{
		Assert::registryProperty(PostProperty::class);
		Assert::registryProperty(CompanyProperty::class);
	}
}