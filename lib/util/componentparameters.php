<?php
namespace Intervolga\Edu\Util;

use Bitrix\Main\Component\ParametersTable;

class ComponentParameters
{
	public static function getComponentParameters($componentName, array $templateName = [])
	{
		$filter = [
			'=COMPONENT_NAME' => $componentName,
		];
		if (!empty($templateName))
			$filter = array_merge($filter, $templateName);

		$getList = ParametersTable::getList([
			'filter' => $filter,
			'select' => [
				'ID',
				'PARAMETERS',
			],
		]);
		$fetch = $getList->fetch();

		return unserialize($fetch['PARAMETERS']);

	}
}