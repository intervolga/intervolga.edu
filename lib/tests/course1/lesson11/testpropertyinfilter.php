<?php

namespace Intervolga\Edu\Tests\Course1\Lesson11;

use Bitrix\Main\Loader;
use CIBlockSectionPropertyLink;
use Intervolga\Edu\Locator\Iblock\Property\AvailableProperty;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Asserts\Assert;

class TestPropertyInFilter extends BaseTest
{
	const SECTION_SOFT_FURNITURE_ID = 1;
	const FURNITURE_PRODUCTS_IBLOCK_ID = 2;
	
	protected static function run()
	{
		if(Loader::includeModule("iblock"))
		{
			$sectionProps = new CIBlockSectionPropertyLink;
			$properties = $sectionProps->GetArray(self::FURNITURE_PRODUCTS_IBLOCK_ID, self::SECTION_SOFT_FURNITURE_ID);
			foreach ($properties as $property)
			{
				if ($property['PROPERTY_ID'] == AvailableProperty::find()['ID'])
				{
					Assert::eq($property['SMART_FILTER'], 'Y');
				}
			}
		}
		
		
	}
}