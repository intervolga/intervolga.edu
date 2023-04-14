<?php
namespace Intervolga\Edu\Tests;

use Intervolga\Edu\FilesTree\ComplexComponentTemplate;
use Intervolga\Edu\FilesTree\SimpleComponentTemplate;

abstract class BaseComplexComponentTemplateTest extends BaseComponentTemplateTest
{
	protected static function run()
	{
		$locatorClass = static::getLocator();
		$templateDir = $locatorClass::find(static::getComponentTemplateTree());
		if ($templateDir) {
			/**
			 * @var ComplexComponentTemplate $templateDir
			 */
			$innerTrees = $templateDir->getInnerTemplatesTrees();
			foreach ($innerTrees as $innerTree) {
				$template = new SimpleComponentTemplate($innerTree->getPath() . '/templates/.default/');
				static::testTemplateTrash($template);
				static::testTemplateCode($template);
			}
		}
	}
}