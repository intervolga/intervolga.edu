<?php
namespace Intervolga\Edu\Tests\Course2\Lesson8;

use Bitrix\Main\Localization\Loc;
use CUserOptions;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Asserts\AssertComponent;
use Intervolga\Edu\Locator\Component\Desktop as DesktopComponent;
use Intervolga\Edu\Locator\IO\Desktop as DesktopPage;
use Intervolga\Edu\Locator\IO\Gadgets;
use Intervolga\Edu\Tests\BaseTest;

class DesktopPageChecker extends BaseTest
{
	protected static function run()
	{
		Assert::fileLocator(DesktopPage::class);
		AssertComponent::componentLocator(DesktopComponent::class);
		Assert::directoryLocator(Gadgets::class);
		if (DesktopPage::find() && Gadgets::find() && DesktopComponent::find()) {
			Assert::notEmpty(\BXGadget::GetById(Gadgets::find()->getName()),
				Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_8_GADGET_NOT_FOUND',
					[
						'#GADGEET_NAME#' => Gadgets::find()->getName()
					]
				)
			);
			$idGadget = DesktopComponent::find()['PARAMETERS']['ID'];
			$arUserOptions = CUserOptions::GetOption('intranet', '~gadgets_' . $idGadget)['GADGETS'];
			Assert::notEmpty($arUserOptions,
				Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_8_GADGET_NOT_FOUND_ON_PAGE',
					[
						'#GADGEET_NAME#' => Gadgets::find()->getName()
					]
				)
			);
		}
	}
}