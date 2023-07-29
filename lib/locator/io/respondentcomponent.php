<?php
namespace Intervolga\Edu\Locator\IO;

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

class RespondentComponent extends DirectoryLocator
{
	protected static function getPaths(): array
	{
		$result = [];
		$namesapces = [
			'custom',
			'intervolga.custom'
		];
		foreach ($namesapces as $name) {
			$basePath = '/local/components/' . $name . '/';
			foreach (INTERVOLGA_EDU_GUESS_VARIANTS['TEMPLATES']['RESPONDENTS_LIST'] as $template) {
				$result[] = $basePath . $template . '/';
			}
		}
		return $result;
	}

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.CUSTOM_COMPONENT_RESPONDENT_DIRECTORY');
	}
	public static function getCode(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.RESPONDENT_DIRECTORY');
	}
}
