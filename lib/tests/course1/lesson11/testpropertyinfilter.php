<?php

namespace Intervolga\Edu\Tests\Course1\Lesson11;

use Bitrix\Main\Loader;
use CIBlockSectionPropertyLink;
use Intervolga\Edu\Locator\Iblock\ProductsIblock;
use Intervolga\Edu\Locator\Iblock\Property\AvailableProperty;
use Intervolga\Edu\Locator\Iblock\Section\SoftFornitureSection;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Asserts\Assert;

class TestPropertyInFilter extends BaseTest
{
	
	protected static function run()
	{
		if(Loader::includeModule("iblock"))
		{
			$sectionProps = new CIBlockSectionPropertyLink;
			$properties = $sectionProps->GetArray(ProductsIblock::find()['ID'], SoftFornitureSection::find()['ID']);
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