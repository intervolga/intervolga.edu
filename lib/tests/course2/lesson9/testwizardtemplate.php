<?php
namespace Intervolga\Edu\Tests\Course2\Lesson9;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\FilesTree\WizardTree;
use Intervolga\Edu\Locator\IO\Wizard;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\Regex;

class TestWizardTemplate extends BaseTest
{
	public static function interceptErrors()
	{
		return true;
	}

	protected static function run()
	{
		Assert::directoryLocator(Wizard::class);
		if ($templateDir = Wizard::find(WizardTree::class)) {
			/**
			 * @var WizardTree $templateDir
			 */
			static::testVersion($templateDir);
			static::testWizardFile($templateDir);
			Assert::fseExists($templateDir->getDescriptionFile());
		}
	}

	protected static function testVersion(WizardTree $templateDir)
	{
		Assert::fseExists($templateDir->getVersionFile());
		if ($templateDir->getVersionFile()->isExists())
		{
			$arWizardVersion = ['VERSION' => ''];
			include $templateDir->getVersionFile()->getPath();
			Assert::notEmpty($arWizardVersion['VERSION'], Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_9_VERSION_NOT_EMPTY'));
		}
	}

	protected static function testWizardFile(WizardTree $templateDir)
	{
		Assert::fseExists($templateDir->getWizardFile());
		if ($templateDir->getWizardFile()->isExists())
		{
			Assert::fileContentMatches(
				$templateDir->getWizardFile(),
				new Regex('/extends CWizardStep/', 'extends CWizardStep')
			);
			Assert::fileContentMatches(
				$templateDir->getWizardFile(),
				new Regex('/\$this->setCancelStep/i', '$this->setCancelStep')
			);
			Assert::fileContentMatches(
				$templateDir->getWizardFile(),
				new Regex('/\$this->setFinishCaption/i', '$this->setFinishCaption')
			);
		}
	}
}