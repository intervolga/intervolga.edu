<?php

namespace Intervolga\Edu;

use Intervolga\Edu\Sniffer\ConfigTools;
use Intervolga\Edu\Sniffer\Message;
use Intervolga\Edu\Sniffer\Runner;
use Intervolga\Edu\Sniffer\StandardsTools;

class Sniffer
{
	/**
	 * @param string[] $paths
	 * @return Message[]
	 */
	public static function run(array $paths, array $standartName)
	{
		$result = [];
		$standards = StandardsTools::getStandardPathByNames($standartName);
		$config = ConfigTools::makeConfig($standards, $paths);

		$runner = new Runner($config);
		$errors = $runner->runPHPCS();
		foreach ($errors as $file => $fileErorrs) {
			foreach ($fileErorrs as $line => $lineErorrs) {
				foreach ($lineErorrs as $column => $columnErrors) {
					foreach ($columnErrors as $columnError) {
						$result[] = new Message($file, $line, $column, $columnError['message'], $columnError['source']);
					}
				}
			}
		}

		return $result;
	}
}
