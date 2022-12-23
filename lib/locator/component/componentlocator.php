<?php
namespace Intervolga\Edu\Locator\Component;

use Bitrix\Main\Component\ParametersTable;

abstract class ComponentLocator
{
	public static function find(): array
	{
		$records = static::getList();
		if ($records) {
			return $records[0];
		} else {
			return [];
		}
	}

	public static function findAll(): array
	{
		$records = static::getList();

		return $records;
	}

	protected static function getList()
	{
		$result = [];
		$getList = ParametersTable::getList([
			'filter' => ['=COMPONENT_NAME' => static::getCode()],
			'select' => [
				'ID',
				'COMPONENT_NAME',
				'TEMPLATE_NAME',
				'PARAMETERS',
				'REAL_PATH',
			]
		]);
		while ($fetch = $getList->fetch()) {
			if ($fetch['PARAMETERS']) {
				$fetch['PARAMETERS'] = unserialize($fetch['PARAMETERS']);
			}
			$result[] = $fetch;
		}

		return $result;
	}

	abstract public static function getCode(): string;
}