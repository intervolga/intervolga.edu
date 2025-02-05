<?php
namespace Intervolga\Edu\Tests\Course1\Lesson11;

use Bitrix\Iblock\InheritedProperty\ElementValues;
use Bitrix\Iblock\InheritedProperty\IblockValues;
use Bitrix\Iblock\InheritedProperty\SectionValues;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use CIBlockElement;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\Iblock\ProductsIblock;
use Intervolga\Edu\Locator\Iblock\Section\OfficeFurniture;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\Regex;

class TestSeoChecker extends BaseTest
{
	public static function interceptErrors()
	{
		return true;
	}

	protected static function run()
	{
		Loader::includeModule('iblock');
		Assert::iblockLocator(ProductsIblock::class);

		if ($iblock = ProductsIblock::find()) {
			static::checkSeoIblock($iblock['ID']);

			Assert::sectionLocator(OfficeFurniture::class);
			if ($section = OfficeFurniture::find()) {
				static::checkSeoSection($iblock['ID'], $section['ID']);
				static::chechkSeoElements($iblock['ID'], $section['ID']);
			}
		}
	}

	protected static function checkSeoIblock($iblockId)
	{
		$ipropIblockValues = new IblockValues($iblockId);
		$seoIblock = $ipropIblockValues->queryValues();

		Assert::matches($value = $seoIblock['ELEMENT_META_TITLE']['TEMPLATE'] ? : '',
			new Regex('/{=this.property.ARTNUMBER}\s*{=this.Name}\s*-\s*{=this.property.PRICE}\s*рублей/iu',
				'{=this.property.ARTNUMBER} {=this.Name} - {=this.property.PRICE} рублей'),
			Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_11_SEO_ELEMENTS', [
				'#VALUE#' => !empty($value) ? : 'не задано',
			]));

		Assert::matches($value = $seoIblock['SECTION_META_KEYWORDS']['TEMPLATE'] ? : '',
			new Regex('/\{=this\.Name}\s*-\s*[\w,\s,\d,\{,\},\[,\],\=,\.,\],]+/iu',
				'{=this.Name} - #произвольный текст#'),
			Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_11_SEO_SECTIONS', [
				'#VALUE#' => !empty($value) ? : 'не задано',
			]));

		Assert::matches($value = $seoIblock['ELEMENT_PREVIEW_PICTURE_FILE_ALT']['TEMPLATE'] ? : '',
			new Regex('/{=parent.Name}\s*-\s*{=this.property.PRICE}/iu',
				'{=parent.Name} - {=this.property.PRICE}'),
			Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_11_SEO_PREVIEW_PICTURE', [
				'#VALUE#' => !empty($value) ? : 'не задано',
			]));

		Assert::matches($value = $seoIblock['ELEMENT_PREVIEW_PICTURE_FILE_TITLE']['TEMPLATE'] ? : '',
			new Regex('/{=parent.Name}\s*-\s*{=this.property.PRICE}/iu',
				'{=parent.Name} - {=this.property.PRICE}'),
			Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_11_SEO_PREVIEW_PICTURE', [
				'#VALUE#' => !empty($value) ? : 'не задано',
			]));

		Assert::matches($value = $seoIblock['ELEMENT_PREVIEW_PICTURE_FILE_NAME']['TEMPLATE'] ? : '',
			new Regex('/{=parent.Name}\s*-\s*{=this.property.PRICE}/iu',
				'{=parent.Name} - {=this.property.PRICE}'),
			Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_11_SEO_PREVIEW_PICTURE', [
				'#VALUE#' => !empty($value) ? : 'не задано',
			]));
	}

	protected static function checkSeoSection($iblockId, $sectionId)
	{
		$ipropSectionValues = new SectionValues($iblockId, $sectionId);
		$seoIblock = $ipropSectionValues->queryValues();

		Assert::matches($value = $seoIblock['ELEMENT_META_KEYWORDS']['TEMPLATE'] ? : '',
			new Regex('/{=this.property.[\w]+},\s*{=this.property.[\w]+}/i',
				'{=this.property.#любое_свойство#}, {=this.property.#любое_свойство#}'),
			Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_11_SEO_OFFICE_FURNITURE', [
				'#VALUE#' => $value ? : 'не задано',
			]));
	}

	protected static function chechkSeoElements($iblockId, $sectionId)
	{
		$elements = [];
		$iblockElems = CIblockElement::GetList(false, [
			'IBLOCK_ID' => $iblockId,
			'SECTION_ID' => $sectionId
		]);
		while ($iblockElement = $iblockElems->fetch()) {
			$iblockValues = new ElementValues($iblockId, $iblockElement['ID']);
			$seoElement = $iblockValues->queryValues();
			$keywords = $seoElement['ELEMENT_META_KEYWORDS']['TEMPLATE'];
			$discription = $seoElement['ELEMENT_META_DESCRIPTION']['TEMPLATE'];

			if (preg_match('/\{=parent\.Name}\s*\,*\s*\{=iblock\.Name}/', $keywords) &&
				preg_match('/\{=this\.PreviewText}/', $discription)) {
				$elements[$iblockElement['ID']] = $iblockElement;
			}
		}

		Assert::greaterEq(count($elements), 1, Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_11_SEO_ELEMENT_COUNT'));
	}
}