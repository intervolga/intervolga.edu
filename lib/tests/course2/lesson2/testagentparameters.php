<?php
namespace Intervolga\Edu\Tests\Course2\Lesson2;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\Agent\CheckStocksAgent;
use Intervolga\Edu\Tests\BaseTest;

class TestAgentParameters extends BaseTest
{
	/**
	 * Чтобы была возможность отключить агенты и не заспамливать почту
	*/
	public static function checkLastResult(): bool
	{
		return true;
	}

	public static function interceptErrors()
	{
		return true;
	}

	protected static function run()
	{
		Assert::agentExists(CheckStocksAgent::class);
		if ($agent = CheckStocksAgent::find()) {
			Assert::eq($agent['ACTIVE'], 'Y');
			Assert::eq($agent['AGENT_INTERVAL'], 86400);
		}
	}
}