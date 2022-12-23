<?php
namespace Intervolga\Edu\Locator\Component;

use Bitrix\Main\Component\ParametersTable;

abstract class ComponentLocator
{
	public static function find(): array
	{
		$getList = ParametersTable::getList([
			'filter' => ['=COMPONENT_NAME' => static::getCode()],
			'select' => [
				'ID',
				'COMPONENT_NAME',
				'PARAMETERS'
			]
		]);
		$result = $getList->fetch();
		$result['PARAMETERS'] = unserialize($result['PARAMETERS']);

		return $result;
	}

	abstract public static function getCode(): string;
}