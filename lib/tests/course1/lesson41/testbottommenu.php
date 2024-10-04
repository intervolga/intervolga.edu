<?php
namespace Intervolga\Edu\Tests\Course1\Lesson41;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\FilesTree\ComponentTemplate;
use Intervolga\Edu\FilesTree\Template\BottomMenuTree;
use Intervolga\Edu\Locator\IO\ComponentTemplate\BottomMenuTemplate;
use Intervolga\Edu\Locator\IO\DirectoryLocator;
use Intervolga\Edu\Tests\BaseComponentTemplateTest;

class TestBottomMenu extends BaseComponentTemplateTest
{
	/**
	 * @return string|DirectoryLocator
	 */
	protected static function getLocator()
	{
		return BottomMenuTemplate::class;
	}

	/**
	 * @return string|ComponentTemplate
	 */
	protected static function getComponentTemplateTree()
	{
		return BottomMenuTree::class;
	}

	protected static function testTemplateTrash(ComponentTemplate $templateDir)
	{
		parent::testTemplateTrash($templateDir);
		static::testTemplateLangEnTrash($templateDir);
	}

	protected static function testTemplateLangEnTrash(ComponentTemplate $templateDir)
	{
		if ($templateDir->getLangEnDir()->isExists()) {
			foreach ($templateDir->getLangEnDir()->getChildren() as $child) {

				if ($child->isDirectory()) {
					if (!in_array($child->getName(), static::getKnownDirNames($templateDir))) {
						Assert::directoryNotExists($child);
					}
				} elseif ($child->isFile()) {
					if (!in_array($child->getName(), static::getKnownFilesNames($templateDir))) {
						Assert::fseNotExists($child);
					} else {
						static::testTemplateLangRu($templateDir, $child);
					}
				}
			}
		}
	}
}
