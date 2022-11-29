<?php
namespace Intervolga\Edu\Util;

use Bitrix\Main\IO\FileSystemEntry;

class PathMask
{
	/**
	 * @param string $mask
	 * @return FileSystemEntry[]
	 */
	public static function getFileSystemEntriesByMask(string $mask): array
	{
		$currents = [FileSystem::getDirectory('/')];
		$parsed = static::parseMask($mask);
		foreach ($parsed as $parsedItem) {
			$newCurrents = [];
			foreach ($currents as $current) {
				foreach ($current->getChildren() as $child) {
					if (static::entryMatches($child, $parsedItem)) {
						$newCurrents[] = $child;
					}
				}
			}
			$currents = $newCurrents;
		}

		return $currents;
	}

	public static function parseMask(string $mask): array
	{
		if (mb_substr($mask, 0, 1) == '/') {
			$mask = mb_substr($mask, 1);
		}
		$maskArray = explode('/', $mask);
		$result = [];
		foreach ($maskArray as $i => $item) {
			if (mb_strlen($item)) {
				$resultItem = [
					'TYPE' => 'FILE',
					'NAME' => $item,
					'REGEX' => static::entryMaskToRegex($item),
				];
				if (array_key_exists($i + 1, $maskArray)) {
					$resultItem['TYPE'] = 'DIR';
				}
				$result[] = $resultItem;
			}
		}

		return $result;
	}

	protected static function entryMaskToRegex(string $mask): string
	{
		$result = '/^' . $mask . '$/ui';
		$result = str_replace('.', '\.', $result);
		$result = str_replace('*', '.*', $result);

		return $result;
	}

	protected static function entryMatches(FileSystemEntry $entry, array $parsedItem)
	{
		$result = false;
		if ($parsedItem['TYPE'] == 'DIR') {
			if ($entry->isDirectory()) {
				if (preg_match($parsedItem['REGEX'], $entry->getName())) {
					$result = true;
				}
			}
		} elseif ($parsedItem['TYPE'] == 'FILE') {
			if ($entry->isFile()) {
				if (preg_match($parsedItem['REGEX'], $entry->getName())) {
					$result = true;
				}
			}
		}

		return $result;
	}
}
