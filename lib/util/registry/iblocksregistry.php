<?php
namespace Intervolga\Edu\Util\Registry;

use Bitrix\Iblock\IblockTable;
use Bitrix\Main\Loader;

class IblocksRegistry
{
	const REVIEW_POSSIBLE_CODES = [
		'review',
	];

	const PROMO_POSSIBLE_CODES = [
		'promo',
		'stock',
		'discount',
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
			foreach ($codes as $codePart) {
				if (mb_substr_count($iblock['CODE'], $codePart)) {
					$result = $iblock;
				}
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
