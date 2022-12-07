<?php

namespace Intervolga\Edu\Util;

use Bitrix\Main\Component\ParametersTable;

class ComponentParameters
{
	public static function getComponentParameters($componentName)
	{
		$getList = ParametersTable::getList([
			'filter' => [
				'=COMPONENT_NAME' => $componentName,
			],
			'select' => [
				'ID',
				'PARAMETERS',
			],
		]);
		$fetch = $getList->fetch();
		return unserialize($fetch['PARAMETERS']);
		
	}
}