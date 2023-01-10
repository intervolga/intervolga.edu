<?php

namespace Intervolga\Edu;

use Intervolga\Edu\Sniffer\ConfigTools;
use Intervolga\Edu\Sniffer\Runner;
use Intervolga\Edu\Sniffer\StandardsTools;

class Sniffer
{
	public static function run(array $paths)
	{
		$standards = StandardsTools::getStandardPathByNames(['general']);
		$config = ConfigTools::makeConfig($standards, $paths);

		$runner = new Runner($config);
		$errors = $runner->runPHPCS();

		return $errors;
	}
}
