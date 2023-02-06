<?php
namespace Intervolga\Edu\Tests\Course1\Lesson41;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\FilesTree\ComponentTemplate;
use Intervolga\Edu\FilesTree\SimpleComponentTemplate;
use Intervolga\Edu\Locator\IO\ComponentTemplate\BottomMenuTemplate;
use Intervolga\Edu\Locator\IO\DirectoryLocator;
use Intervolga\Edu\Tests\BaseComponentTemplateTest;

class TestBottomMenu extends BaseComponentTemplateTest
{

	protected static function run()
	{
		parent::run();
		$fields = ['/company/reviews/', '/contacts/', '/company/management/', '/company/history/'];

		foreach ($fields as $field) {
			Assert::menuItemExists('/.bottom.menu.php', $field);
		}
	}

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
		return SimpleComponentTemplate::class;
	}
}
