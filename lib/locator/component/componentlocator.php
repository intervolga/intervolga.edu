<?php
namespace Intervolga\Edu\Locator\Component;

use Bitrix\Main\Component\ParametersTable;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Locator\BaseLocator;

Loc::loadMessages(__FILE__);

abstract class ComponentLocator extends BaseLocator
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

	abstract public static function getCode();

	protected static function getFoundFilePath($find)
	{
		return $find['REAL_PATH'];
	}

	public static function getDisplayText($find): string
	{
		return $find['REAL_PATH'];
	}

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.COMPONENT_CALL', [
			'#COMPONENT#' => static::getCode(),
		]);
	}
}