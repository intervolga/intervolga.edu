<?php
namespace Intervolga\Edu\Locator\Iblock\Section;

use Bitrix\Iblock\SectionTable;
use Bitrix\Main\Loader;
use Intervolga\Edu\Locator\Iblock\IblockLocator;

abstract class SectionLocator
{
	/**
	 * @return string|IblockLocator
	 */
	abstract public static function getIblock();
	
	abstract public static function getFilter(): array;
	
	abstract public static function getNameLoc(): string;
	
	public static function find(): array
	{
		$result = [];
		Loader::includeModule('iblock');
		$iblockClass = static::getIblock();
		$iblockArray = $iblockClass::find();
		if ($iblockArray)
		{
			$getList = SectionTable::getList([
				'order' => [
					'ID' => 'ASC',
				],
				'filter' => array_merge(
					[
						'IBLOCK_ID' => $iblockArray['ID'],
					],
					static::getFilter()
				),
			]);
			if ($fetch = $getList->fetch()) {
				$result = $fetch;
			}
		}
		
		return $result;
	}
}