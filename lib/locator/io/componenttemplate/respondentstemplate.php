<?php
namespace Intervolga\Edu\Locator\IO\ComponentTemplate;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Locator\IO\DirectoryLocator;

class RespondentsTemplate extends DirectoryLocator
{
	protected static function getPaths(): array
	{
		return [
			'/local/components/intervolga/respondents/templates/.default/',
			'/local/components/intervolga/poll_results/templates/.default/',
		];
	}

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.RESPONDENTS_TEMPLATE');
	}

}