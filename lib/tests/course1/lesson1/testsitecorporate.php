<?php
namespace Intervolga\Edu\Tests\Course1\Lesson1;

use Intervolga\Edu\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\FileSystem;
use Intervolga\Edu\Util\Registry\Iblock\NewsIblock;
use Intervolga\Edu\Util\Registry\Iblock\ProductsIblock;

class TestSiteCorporate extends BaseTest
{
	public static function run()
	{
		Assert::moduleInstalled('bitrix.sitecorporate');
		Assert::registryIblock(ProductsIblock::class);
		Assert::registryIblock(NewsIblock::class);
		Assert::directoryExists(FileSystem::getDirectory('/products/'));
		Assert::directoryExists(FileSystem::getDirectory('/company/'));
		Assert::directoryExists(FileSystem::getDirectory('/contacts/'));
	}
}