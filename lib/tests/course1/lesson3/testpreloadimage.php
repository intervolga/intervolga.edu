<?php
namespace Intervolga\Edu\Tests\Course1\Lesson3;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\FileSystem;
use Intervolga\Edu\Util\Regex;

class TestPreloadImage extends BaseTest
{
	public static function checkLastResult(): bool
	{
		return true;
	}
	protected static function run()
	{
		$mainHeader = FileSystem::getFile('/local/templates/main/header.php');
		$regex = new Regex('/preloadImage:\s*("|\')\/local\/templates\/\.default\/images\/loading\.gif("|\')/i',
			'preloadImage: \'/local/templates/.default/images/loading.gif\'');
		Assert::fileContentMatches($mainHeader, $regex);
	}
}