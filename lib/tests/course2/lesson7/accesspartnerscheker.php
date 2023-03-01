<?php
namespace Intervolga\Edu\Tests\Course2\Lesson7;

use Bitrix\Main\Localization\Loc;
use CGroup;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\IO\AccessFile;
use Intervolga\Edu\Locator\IO\PartnersSection;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\GroupUserList;

class AccessPartnersCheker extends BaseTest
{
	protected static function run()
	{
		$groupPartnersId = CGroup::GetList(false, false, ['STRING_ID' => 'partners'])->fetch()['ID'];
		Assert::notEmpty($groupPartnersId, Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_7_STRING_ID_PARTNERS'));
		Assert::fileLocator(AccessFile::class);
		if (AccessFile::find()) {
			include AccessFile::find()->getPath();
			Assert::directoryLocator(PartnersSection::class);
			$partnersSection = PartnersSection::find()->getName();

			Assert::eq($PERM[$partnersSection]['*'], 'D',
				Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_7_ACCESS_FOR_ALL'));
			Assert::eq($PERM[$partnersSection]['G' . $groupPartnersId], 'R',
				Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_7_ACCESS_FOR_PARTNERS'));
		}
	}
}