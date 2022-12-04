<?php
namespace Intervolga\Edu\Tests;

use Bitrix\Main\IO\Directory;
use Intervolga\Edu\FilesTree\ComplexComponentTemplate;
use Intervolga\Edu\FilesTree\SimpleComponentTemplate;

abstract class BaseComplexComponentTemplateTest extends BaseComponentTemplateTest
{
	protected static function run()
	{
		parent::run();
		$locatorClass = static::getLocator();
		$templateDir = $locatorClass::find(static::getComponentTemplateTree());
		/**
		 * @var ComplexComponentTemplate $templateDir
		 */
		$innerTemplates = $templateDir->getInnerTemplatesDir();
		if ($innerTemplates->isExists()) {
			foreach ($innerTemplates->getChildren() as $innerComponentDir) {
				if ($innerComponentDir instanceof Directory) {
					foreach ($innerComponentDir->getChildren() as $innerTemplateDir) {
						static::testTemplateTrash(new SimpleComponentTemplate($innerTemplateDir->getPath()));
						static::testTemplateCode(new SimpleComponentTemplate($innerTemplateDir->getPath()));
					}
				}
			}
		}
	}
}