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

	/**
	 * @return string
	 */
	public static function getPossibleTips()
	{
		$result = [];
		$filter = static::getFilter();
		foreach ($filter as $field => $value) {
			if (mb_substr($field, 0, 1) == '=') {
				$field = mb_substr($field, 1);
			}
			if (!is_array($value)) {
				$value = [$value];
			}
			$result[] = $field . '=' . implode('||', $value);
		}

		return implode(';', $result);
	}

}