<?php
namespace Intervolga\Edu\Sniffer\Filters;

class Filter extends \PHP_CodeSniffer\Filters\Filter
{
	protected function shouldProcessFile($path)
	{
		$result = parent::shouldProcessFile($path);
		$fileName = basename($path);
		$fileParts = explode('.', $fileName);
		if (!$result && $fileParts[0] === '') {
			$result = true;
		}

		return $result;
	}
}