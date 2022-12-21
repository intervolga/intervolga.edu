<?php
namespace Intervolga\Edu\Locator\Component\Template;

use Bitrix\Main\Component\ParametersTable;
use Intervolga\Edu\Locator\Component\ComponentLocator;

abstract class TemplateLocator
{
	public static function find(): array
	{
		$result = [];
		if (static::getComponent()::find()) {
			$getList = ParametersTable::getList([
				'filter' => array_merge(['=COMPONENT_NAME' => static::getComponent()::getComponentName()], static::getFilter()),
				'select' => [
					'ID',
					'COMPONENT_NAME',
					'PARAMETERS'
				]
			]);
			while ($rows = $getList->fetch()) {
				if (!empty($rows)) {
					$result = $rows;
					$result['PARAMETERS'] = unserialize($rows['PARAMETERS']);
				}
			}

			return $result;
		}

		return $result;

	}

	/**
	 * @return string|ComponentLocator
	 */
	abstract public static function getComponent(): string;
	abstract public static function getNameLoc(): string;
	abstract public static function getFilter(): array;

}