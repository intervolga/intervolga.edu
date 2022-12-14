<?php

namespace Intervolga\Edu\Locator\Component;

use Bitrix\Iblock\IblockTable;
use Bitrix\Main\Component\ParametersTable;
use Bitrix\Main\Loader;
use Intervolga\Edu\Asserts\AssertComponent;

abstract class ComponentLocator
{

	public static function find(): array
	{
		AssertComponent::checkComponentInTable(static::getFilter());

		$getList = ParametersTable::getList([
			'filter' =>	static::getFilter(),
			'select' => ['ID', 'COMPONENT_NAME', 'PARAMETERS']
			]);
		$result = $getList->fetch();
		$result['PARAMETERS'] = unserialize($result['PARAMETERS']);

		return $result;
	}

	abstract public static function getFilter() : array;
}