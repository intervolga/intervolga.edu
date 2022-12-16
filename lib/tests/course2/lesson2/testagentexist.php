<?php

namespace Intervolga\Edu\Tests\Course2\Lesson2;

use CAgent;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\FileSystem;
use ReflectionFunction;

class TestAgentExist extends BaseTest
{
	protected static function run()
	{
		Assert::fseExists(self::getInitFile());
		$list = CAgent::GetList(false,
			['MODULE_ID' => 'main']
		);
		while ($rows = $list->fetch()) {
			//\Bitrix\Main\Diag\Debug::dump($rows);
			$functionNames[] = $rows['NAME'];
		}

		\Bitrix\Main\Diag\Debug::dump($functionNames);
		foreach ($functionNames as $functionName){
			$name = substr($functionName, strpos($functionName, '::')+2);
			$name = substr($name, 0, -1);
			\Bitrix\Main\Diag\Debug::dump($name);
			\Bitrix\Main\Diag\Debug::dump(function_exists($name));
			//if(function_exists($name))
			//$file_function = new ReflectionFunction('submitData');
			//$functionPaths[] = $file_function->getFileName() . ':' . $file_function->getStartLine();
		}
		//\Bitrix\Main\Diag\Debug::dump($functionPaths);
		//$file_function = new ReflectionFunction('function_name');
		//print $file_function->getFileName() . ':' . $file_function->getStartLine();

		//\Bitrix\Main\Diag\Debug::dump(self::getInitFile()->isExists());
		//Assert::fileContentMatches(static::getInitFile(), new Regex('', 'не подключен в init'));

	}

	protected static function getInitFile()
	{
		return FileSystem::getFile('/local/php_interface/init.php');
	}
}