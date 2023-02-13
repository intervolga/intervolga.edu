<?php
namespace Intervolga\Edu\Util;

use Bitrix\Main\Application;

class DBHelper
{
	public static function getCacheFromTag(string $tag)
	{
		$result = [];
		if (!empty($tag)) {
			$con = Application::getConnection();
			$sqlHelper = $con->getSqlHelper();

			$rs = $con->query("
				SELECT *
				FROM b_cache_tag
				WHERE TAG = '" . $sqlHelper->forSql($tag) . "'
			");

			while ($ar = $rs->fetch()) {
				$result[] = $ar;
			}
		}

		return $result;
	}
}