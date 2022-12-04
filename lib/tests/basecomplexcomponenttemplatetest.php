<?php
namespace Intervolga\Edu\Tests;

use Intervolga\Edu\FilesTree\ComplexComponentTemplate;

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
		$innerTrees = $templateDir->getInnerTemplatesTrees();
		foreach ($innerTrees as $innerTree) {
			static::testTemplateTrash($innerTree);
			static::testTemplateCode($innerTree);
		}
	}
}