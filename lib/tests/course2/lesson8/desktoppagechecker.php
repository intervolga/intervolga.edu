<?php
namespace Intervolga\Edu\Tests\Course2\Lesson8;

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
		if (Gadgets::find() && DesktopComponent::find()) {
			Assert::notEmpty(\BXGadget::GetById(Gadgets::find()->getName()), 'гаджет не существует');
			$idGadget = DesktopComponent::find()['PARAMETERS']['ID'];
			$arUserOptions = CUserOptions::GetOption('intranet', '~gadgets_' . $idGadget)['GADGETS'];
			Assert::notEmpty($arUserOptions, 'гаджет не размещен на странице');
		}
	}
}