<?php

namespace Intervolga\Edu\Locator\Component;

use Bitrix\Main\Localization\Loc;

class CustomVacancies extends ComponentLocator
{

	public static function getCode()
	{
		$customCodes = [];
		foreach (INTERVOLGA_EDU_GUESS_VARIANTS['CUSTOM_COMPONENTS'] as $customNames){
			$customCodes[] = $customNames.':vacancies';
		}
		return $customCodes;
	}
	public static function getPossibleTips()
	{
		return implode(' || ', INTERVOLGA_EDU_GUESS_VARIANTS['CUSTOM_COMPONENTS']);
	}
	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.COMPONENT_CUSTOM_VACANCIES');
	}
}