<?php
namespace Intervolga\Edu\Locator\Component\Template;

use Bitrix\Main\Component\ParametersTable;
use Intervolga\Edu\Locator\BaseLocator;
use Intervolga\Edu\Locator\Component\ComponentLocator;

abstract class TemplateLocator extends BaseLocator
{
	public static function find(): array
	{
		$result = [];
		if (static::getComponent()::find()) {
			$getList = ParametersTable::getList([
				'filter' => array_merge(['=COMPONENT_NAME' => static::getComponent()::getCode()], static::getFilter()),
				'select' => [
					'ID',
					'COMPONENT_NAME',
					'TEMPLATE_NAME',
					'PARAMETERS',
					'REAL_PATH',
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

	public static function getDisplayText($find): string
	{
		return $find['TEMPLATE_NAME'];
	}

	protected static function getFoundDirectoryPath($find)
	{
		return $find['REAL_PATH'];
	}
}