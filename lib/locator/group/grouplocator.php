<?php
namespace Intervolga\Edu\Locator\Group;

use CGroup;
use Intervolga\Edu\Locator\BaseLocator;

abstract class GroupLocator extends BaseLocator
{
	abstract public static function getNameLoc(): string;

	abstract public static function getCodeGroup(): string;

	public static function find()
	{
		return CGroup::GetList(false, false, ['STRING_ID' => static::getCodeGroup()])->fetch();
	}
}