<?php
namespace Intervolga\Edu\Util\Registry;

use Bitrix\Iblock\PropertyTable;
use Bitrix\Main\Loader;

class IblockPropertyRegistry
{
	const POST_POSSIBLE_CODES = [
		'POST',
		'POSITION',
		'WORK',
	];

	const COMPANY_POSSIBLE_CODES = [
		'COMPANY',
	];

	public static function getPostProperty(array $iblock): array
	{
		return static::getPropertyByCodes($iblock, static::POST_POSSIBLE_CODES);
	}

	public static function getCompanyProperty(array $iblock): array
	{
		return static::getPropertyByCodes($iblock, static::COMPANY_POSSIBLE_CODES);
	}

	public static function getPropertyByCodes(array $iblock, array $codes): array
	{
		$result = [];

		$properties = static::getProperties($iblock['ID']);
		foreach ($properties as $property) {
			if (in_array($property['CODE'], $codes)) {
				$result = $property;
			}
		}

		return $result;
	}

	protected static function getProperties(int $iblockId): array
	{
		Loader::includeModule('iblock');
		$result = [];

		$getList = PropertyTable::getList([
			'filter' => [
				'IBLOCK_ID' => $iblockId,
				'ACTIVE' => 'Y',
			],
		]);
		while ($fetch = $getList->fetch()) {
			$result[] = $fetch;
		}

		return $result;
	}
}
