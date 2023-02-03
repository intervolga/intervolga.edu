<?php
namespace Intervolga\Edu\Tests\Course2\Lesson8;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\FilesTree\ComponentTemplate;
use Intervolga\Edu\FilesTree\GadgetTemplate;
use Intervolga\Edu\Locator\IO\ComponentTemplate\DesktopTemplate;
use Intervolga\Edu\Locator\IO\DirectoryLocator;
use Intervolga\Edu\Tests\BaseComponentTemplateTest;

class GadgetComponentTest extends BaseComponentTemplateTest
{
	protected static function testTemplateLangRuTrash(ComponentTemplate $templateDir)
	{
		//todo - ругается на языковой .parameters + убрать проверку по снифферу? т.к. шаблон битриксовый, по заданию не менять
		/*if ($templateDir->getLangRuDir()->isExists()) {
			foreach ($templateDir->getLangRuDir()->getChildren() as $child) {
				if ($child->getName() == $templateDir->getDescriptionFile()->getName()) {
					Assert::fseNotExists($child);
				} elseif ($child->getName() == $templateDir->getParametersFile()->getName()) {
					Assert::fseNotExists($child);
				} elseif ($templateDir instanceof SimpleComponentTemplate) {
					if ($child->getName() != $templateDir->getTemplateFile()->getName()) {
						Assert::fseNotExists($child);
					}
				} elseif ($templateDir instanceof NewsTemplate) {
					if (!in_array($child->getName(), [
						$templateDir->getNewsFile()->getName(),
						$templateDir->getDetailFile()->getName()
					])) {
						Assert::fseNotExists($child);
					}
				}
			}
		}*/
	}



	/**
	 * @return string|DirectoryLocator
	 */
	protected static function getLocator()
	{
		return DesktopTemplate::class;
	}

	/**
	 * @return string|ComponentTemplate
	 */
	protected static function getComponentTemplateTree()
	{
		return GadgetTemplate::class;
	}

	protected static function checkRequiredFilesTemplate($templateDir)
	{
		Assert::fseExists($templateDir->getTemplateFile());
		Assert::fseExists($templateDir->getResultModifier());
		Assert::fseExists($templateDir->getParametersFile());
	}

	protected static function checkNotExistingFiles($templateDir)
	{
		Assert::fseNotExists($templateDir->getDescriptionFile());
	}
}