<?php
namespace Intervolga\Edu\Tests;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;


Loc::loadMessages(__FILE__);

abstract class BaseTestIblockElement extends BaseTest
{
	protected static function getCount(){
		return \CIBlockElement::GetList(['cnt'], ['ACTIVE'=>'Y', 'IBLOCK_ID'=>static::getIblockLocator()['ID']], []);
	}

	protected static function find(){
		return \CIBlockElement::GetList([], ['ACTIVE'=>'Y', 'IBLOCK_ID'=> static::getIblockLocator()['ID']]);
	}
	abstract protected static function getIblockLocator() : array;
	abstract protected static function checkElement(array $element) : void;

	protected static function run()
	{
		$elements = self::find();
		while ($element = $elements->fetch()){
			static::checkElement($element);
		}
	}
	public static function interceptErrors()
	{
		return true;
	}
}
