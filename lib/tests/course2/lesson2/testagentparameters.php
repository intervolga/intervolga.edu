<?php
namespace Intervolga\Edu\Tests\Course2\Lesson2;

use Bitrix\Main\Localization\Loc;
use CAgent;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;
use ReflectionFunction;

class TestAgentParameters extends BaseTest
{
	public static function interceptErrors()
	{
		return true;
	}

	protected static function run()
	{
		$parameters = static::getAgentParameters();
		Assert::notEmpty($parameters, Loc::getMessage('INTERVOLGA_EDU.AGENT_PARAMETERS_NOT_FOUND'));
		if ($parameters) {
			Assert::eq($parameters['ACTIVE'], 'Y');
			Assert::eq($parameters['MODULE_ID'], 'main');
			Assert::eq($parameters['AGENT_INTERVAL'], 86400);
		}
	}

	protected static function getAgentParameters()
	{
		$names = CAgent::getList(false,
			['MODULE_ID' => 'main']
		);
		while ($rows = $names->fetch()) {
			$functionNames[] = $rows['NAME'];
		}

		foreach ($functionNames as $functionName) {
			$name = substr($functionName, 0, strpos($functionName, '('));

			if (function_exists($name)) {
				$file_function = new ReflectionFunction($name);
				if (!empty(strpos($file_function->getFileName() . ':' . $file_function->getStartLine(), 'agent.php'))) {
					$functionPaths[$functionName] = $file_function->getFileName() . ':' . $file_function->getStartLine();
				}
			}
		}

		$parameters = CAgent::GetList(false,
			['NAME' => key($functionPaths)]
		)->Fetch();

		return $parameters;
	}
}