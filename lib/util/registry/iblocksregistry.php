<?php
namespace Intervolga\Edu\Util\Registry;

use Bitrix\Iblock\IblockTable;
use Bitrix\Main\Loader;

class IblocksRegistry
{
	const REVIEW_POSSIBLE_CODES = [
		'reviews',
	];

	const PROMO_POSSIBLE_CODES = [
		'promo',
		'promos',
		'stock',
	];

	public static function getReviewsIblock(): array
	{
		return static::guessIblock(static::REVIEW_POSSIBLE_CODES);
	}

	public static function getPromoIblock(): array
	{
		return static::guessIblock(static::PROMO_POSSIBLE_CODES);
	}

	protected static function guessIblock(array $codes): array
	{
		$result = [];
		$iblocks = static::getIblocks();
		foreach ($iblocks as $iblock) {
			if (in_array($iblock['CODE'], $codes)) {
				$result = $iblock;
			}
		}

		return $result;
	}

	protected static function getIblocks(): array
	{
		$result = [];
		Loader::includeModule('iblock');
		$getList = IblockTable::getList([
			'order' => [
				'ID' => 'ASC',
			],
		]);
		while ($fetch = $getList->fetch()) {
			$result[$fetch['ID']] = $fetch;
		}

		return $result;
	}
}
