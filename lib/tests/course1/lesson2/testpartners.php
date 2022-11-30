<?php
namespace Intervolga\Edu\Tests\Course1\Lesson2;

use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\Registry\Directory\PartnersDirectory;

class TestPartners extends BaseTest
{
	public static function run()
	{
		static::registerErrorIfRegistryDirectoryLost(PartnersDirectory::class);
	}
}