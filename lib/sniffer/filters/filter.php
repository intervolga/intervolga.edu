<?php
namespace Intervolga\Edu\Sniffer\Filters;

class Filter extends \PHP_CodeSniffer\Filters\Filter
{
	protected function shouldProcessFile($path)
	{
		$result = parent::shouldProcessFile($path);
		if (!$result) {
			$fileName = basename($path);
			if ($fileName[0] === '.') {
				$result = true;
			}
		}

		return $result;
	}
}