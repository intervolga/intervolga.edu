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
	public static function interceptErrors()
	{
		return true;
	}

	protected static function run()
	{
		Assert::moduleFileExists(EditFile::class);
		Assert::moduleFileExists(MenuFile::class);
		Assert::moduleFileExists(TableFile::class);

		Assert::moduleFileExists(AdminEditFile::class);
		Assert::moduleFileExists(AdminTableFile::class);
	}
}