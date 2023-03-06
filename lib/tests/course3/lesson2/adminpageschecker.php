<?php
namespace Intervolga\Edu\Tests\Course3\Lesson2;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\Module\AdminFiles\EditFile;
use Intervolga\Edu\Locator\Module\AdminFiles\MenuFile;
use Intervolga\Edu\Locator\Module\AdminFiles\TableFile;
use Intervolga\Edu\Locator\Module\InstallFiles\Admin\AdminEditFile;
use Intervolga\Edu\Locator\Module\InstallFiles\Admin\AdminTableFile;
use Intervolga\Edu\Tests\BaseTest;

class AdminPagesChecker extends BaseTest
{
	protected static function run()
	{
		Assert::fileLocator(EditFile::class);
		Assert::fileLocator(MenuFile::class);
		Assert::fileLocator(TableFile::class);

		Assert::fileLocator(AdminEditFile::class);
		Assert::fileLocator(AdminTableFile::class);
	}
}