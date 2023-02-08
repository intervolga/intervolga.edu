<?php
namespace Intervolga\Edu\Locator;

use Bitrix\Main\Localization\Loc;

class DumpFunction extends FunctionLocator
{
	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.HOW_BECOME_PARTNER');
	}

	/**
	 * @return string[]
	 */
	protected static function getPossibleNames()
	{
		return [
			'test_dump',
			'dump',
			'dump_test'
		];
	}
}