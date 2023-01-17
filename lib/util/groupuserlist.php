<?php
namespace Intervolga\Edu\Util;

use CGroup;

class GroupUserList
{
	public static function getGroupList(array $filter = [])
	{
		$rsGroups = CGroup::GetList(false, false, $filter);
		while ($row = $rsGroups->Fetch()) {
			$result [$row['ID']] = $row;
		}

		return $result;
	}
}