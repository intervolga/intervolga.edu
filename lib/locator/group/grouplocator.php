<?php
namespace Intervolga\Edu\Locator\Group;

use CGroup;
use Intervolga\Edu\Locator\BaseLocator;

abstract class GroupLocator extends BaseLocator
{
	abstract public static function getNameLoc(): string;

	public static function getPossibleTips(): string
	{
		return implode(' || ', static::getCodeGroup());
	}

	abstract public static function getCodeGroup(): array;

	public static function find()
	{
		return CGroup::GetList(false, false, ['STRING_ID' => static::getPossibleTips()])->fetch();
	}
}