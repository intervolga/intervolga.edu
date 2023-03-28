<?php
namespace Intervolga\Edu\Tests\Course2\Lesson8;

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Type\Date;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\Component\Desktop;
use Intervolga\Edu\Locator\IO\Desktop as DesktopPage;
use Intervolga\Edu\Locator\IO\Gadgets;
use Intervolga\Edu\Tests\BaseTest;

class TestSettingResultLinks extends BaseTest
{
	const TODAY_LINK = '/bitrix/admin/form_result_list.php?lang=ru&WEB_FORM_ID=#ID#&action=list&find_date_create_1=#DATE#&find_date_create_2=#DATE#&set_filter=Y';
	const GENERAL_LINK = '/bitrix/admin/form_result_list.php?lang=ru&WEB_FORM_ID=#ID#&del_filter=Y';

	public static function interceptErrors()
	{
		return true;
	}

	protected static function run()
	{
		Assert::fileLocator(DesktopPage::class);
		Assert::directoryLocator(Gadgets::class);

		$todayLinkIndex = 0;
		$allLinkIndex = 1;

		if (Desktop::find() && Gadgets::find()) {
			$formId = Desktop::find()['PARAMETERS']['G_' . mb_strtoupper(Gadgets::find()->getName()) . '_FORM_ID'];
			static::urlChecker($formId, $todayLinkIndex, $allLinkIndex, false, false,
				[
					'todayLink' => Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_8_TODAY_URL'),
					'generalLink' => Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_8_GENERAL_URL')
				]);
			static::urlChecker($formId, $todayLinkIndex, $allLinkIndex, 'test1');
			static::urlChecker($formId, $todayLinkIndex, $allLinkIndex, '', 'test2');
			static::urlChecker($formId, $todayLinkIndex, $allLinkIndex, 'test3', 'test4');
		}
	}

	protected static function urlChecker($formId, &$todayLinkIndex, &$allLinkIndex, $templateUrlGeneral = '', $templateUrlIndividual = '', $message = [])
	{
		if (empty($message)) {
			$message['todayLink'] = Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_8_WRONG_URL_GENERAL');
			$message['generalLink'] = Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_8_WRONG_URL_TODAY');
		}
		$gadgetUrls = static::getGadgetUrls($formId, $todayLinkIndex, $allLinkIndex, $templateUrlGeneral, $templateUrlIndividual);
		$expectedUrls = static::getExpectedUrls($formId, $templateUrlGeneral, $templateUrlIndividual);
		Assert::eq($gadgetUrls['todayLink'], $expectedUrls['todayLink'], $message['todayLink']);
		Assert::eq($gadgetUrls['generalLink'], $expectedUrls['generalLink'], $message['generalLink']);
	}

	protected static function getGadgetUrls($formId, &$todayLinkIndex, &$allLinkIndex, $templateUrlGeneral, $templateUrlIndividual)
	{
		$indexPath = Gadgets::find()->getPath() . '/index.php';

		ob_start();
		$arGadgetParams = [
			"TITLE_STD" => "new_gadget_test",
			"SHOW_UNACTIVE_ELEMENTS" => "Y",
			"TEMPLATE_URL_GENERAL" => $templateUrlGeneral,
			"TEMPLATE_URL_INDIVIDUAL" => $templateUrlIndividual,
			"TEMPLATE_URL" => "",
			"FORM_ID" => $formId
		];
		include $indexPath;
		$page = ob_get_contents();
		ob_clean();

		preg_match_all('/href="[\w\s\d\=\'"\/_\.\?&;]*\>/iu', $page, $matches, PREG_SET_ORDER);
		foreach ($matches as $match) {
			$urls[] = mb_strcut($match[0], strpos($match[0], '"') + 1, -2);
		}

		if (strpos($urls[1], 'find_date_create_1')) {
			$allLinkIndex = 0;
			$todayLinkIndex = 1;
		}

		return [
			'todayLink' => $urls[$todayLinkIndex],
			'generalLink' => $urls[$allLinkIndex]
		];
	}

	protected static function getExpectedUrls($formId, $templateUrlGeneral, $templateUrlIndividual)
	{
		$result['generalLink'] = $templateUrlGeneral;
		$result['todayLink'] = $templateUrlIndividual;
		$today = (new Date())->toString();

		if (!$result['generalLink']) {
			$result['generalLink'] = str_replace(
				[
					'#ID#',
					'#DATE#'
				],
				[
					$formId,
					$today
				],
				static::GENERAL_LINK);
		}
		if (!$result['todayLink']) {
			$result['todayLink'] = str_replace(
				[
					'#ID#',
					'#DATE#'
				],
				[
					$formId,
					$today
				],
				static::TODAY_LINK);
		}

		return $result;
	}
}