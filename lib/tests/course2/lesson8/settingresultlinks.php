<?php
namespace Intervolga\Edu\Tests\Course2\Lesson8;

use Bitrix\Main\Localization\Loc;
use CSite;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\Component\Desktop;
use Intervolga\Edu\Locator\IO\Desktop as DesktopPage;
use Intervolga\Edu\Locator\IO\Gadgets;
use Intervolga\Edu\Tests\BaseTest;

class SettingResultLinks extends BaseTest
{
	protected static function run()
	{
		Assert::fileLocator(DesktopPage::class);

		if (Desktop::find()) {
			$formId = Desktop::find()['PARAMETERS']['G_' . mb_strtoupper(Gadgets::find()->getName()) . '_FORM_ID'];
			static::urlChecker($formId);
			static::urlChecker($formId, 'test1');
			static::urlChecker($formId, '', 'test2');
			static::urlChecker($formId, 'test3', 'test4');
		}
	}

	protected static function urlChecker($formId, $templateUrlGeneral = '', $templateUrlIndividual = '')
	{
		$gadgetUrls = static::getGadgetUrls($formId, $templateUrlGeneral, $templateUrlIndividual);
		$expectedUrls = static::getExpectedUrls($formId, $templateUrlGeneral, $templateUrlIndividual);
		Assert::eq($gadgetUrls['todayLink'], $expectedUrls['todayLink'], Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_8_TODAY_URL'));
		Assert::eq($gadgetUrls['generalLink'], $expectedUrls['generalLink'], Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_8_GENERAL_URL'));
	}

	protected static function getGadgetUrls($formId, $templateUrlGeneral, $templateUrlIndividual)
	{
		ob_start();
		$arGadgetParams = [
			"TITLE_STD" => "new_gadget_test",
			"SHOW_UNACTIVE_ELEMENTS" => "Y",
			"TEMPLATE_URL_GENERAL" => $templateUrlGeneral,
			"TEMPLATE_URL_INDIVIDUAL" => $templateUrlIndividual,
			"TEMPLATE_URL" => "",
			"FORM_ID" => $formId
		];
		include $_SERVER['DOCUMENT_ROOT'] . '/local/gadgets/custom/list_resumes/index.php';
		$test = ob_get_contents();
		ob_clean();

		preg_match_all('/href="[\w\s\d\=\'"\/_\.\?&;]*\>/iu', $test, $matches, PREG_SET_ORDER);
		foreach ($matches as $match) {
			$urls[] = mb_strcut($match[0], strpos($match[0], '"') + 1, -2);
		}

		return [
			'todayLink' => $urls[0],
			'generalLink' => $urls[1]
		];
	}

	protected static function getExpectedUrls($formId, $templateUrlGeneral, $templateUrlIndividual)
	{
		global $DB;

		$result['generalLink'] = $templateUrlGeneral;
		$result['todayLink'] = $templateUrlIndividual;

		if (empty($templateUrlGeneral)) {
			$generalLink = "/bitrix/admin/form_result_list.php?lang=ru&WEB_FORM_ID=#ID#&del_filter=Y";
			$today = date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), time());
			$result['generalLink'] = str_replace(
				[
					'#ID#',
					'#DATE#'
				],
				[
					$formId,
					$today
				],
				$generalLink);
		}
		if (empty($templateUrlIndividual)) {
			$todayLink = "/bitrix/admin/form_result_list.php?lang=ru&WEB_FORM_ID=#ID#&action=list&find_date_create_1=#DATE#&find_date_create_2=#DATE#&set_filter=Y";
			$today = date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), time());
			$result['todayLink'] = str_replace(
				[
					'#ID#',
					'#DATE#'
				],
				[
					$formId,
					$today
				],
				$todayLink);
		}

		return $result;
	}
}