<?php
namespace Intervolga\Edu\Locator\UserField;

abstract class UserFieldLocator
{
	abstract protected static function rules() : array;
	abstract public static function getRules() : array;
}