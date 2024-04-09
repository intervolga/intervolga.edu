<?php
namespace Intervolga\Edu\Tests\Course2New\Lesson2;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\Agent\NewsCountAgent;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\FileSystem;
use Intervolga\Edu\Util\Regex;

class TestAgents extends BaseTest
{
	public static function interceptErrors()
	{
		return true;
	}

	protected static function run()
	{
		$file = FileSystem::getFile('/local/modules/mycompany.custom/lib/agents/newscount.php');
		Assert::fseExists($file);
		if (!empty($file->getPath())) {
			Assert::fileContentMatches($file, new Regex('/checkNewsCountAgent/', 'checkNewsCountAgent'));
			Assert::fileContentMatches($file, new Regex('/return\s*__METHOD__\s*\.\s*\"\(\$lastId/', 'return __METHOD__ . "($lastId)'));
		}

		Assert::agentExists(NewsCountAgent::class);
		if ($agent = NewsCountAgent::find())
		{
			Assert::eq($agent['ACTIVE'], 'Y');
			Assert::eq($agent['AGENT_INTERVAL'], 86400);
		}
	}
}