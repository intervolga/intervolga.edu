<?php
namespace Intervolga\Edu\Tests\Course1\Lesson3;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;

class TestTemplateConditions extends BaseTest
{
	protected static function run()
	{
		Assert::templateEqCondition('main', 'CSite::InDir(\'/index.php\')');
		Assert::templateEqCondition('inner', '');
	}

	public static function interceptErrors()
	{
		return true;
	}
}