<?php
namespace Intervolga\Edu\Locator\IO\ComponentTemplate;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Locator\IO\DirectoryLocator;

class SliderTemplate extends DirectoryLocator
{
	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.IO_SLIDER_TEMPLATE');
	}

	protected static function getPaths(): array
	{
		$result = [];
		$basePath = '/local/templates/.default/components/bitrix/news.list/';
		foreach (INTERVOLGA_EDU_GUESS_VARIANTS['TEMPLATES']['SLIDER'] as $template) {
			$result[] = $basePath . $template . '/';
		}

		return $result;
	}
}