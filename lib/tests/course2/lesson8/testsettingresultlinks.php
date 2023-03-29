<?php
namespace Intervolga\Edu\Tests\Course2\Lesson8;

use Bitrix\Main\IO\File;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Type\Date;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\Component\Desktop;
use Intervolga\Edu\Locator\IO\Desktop as DesktopPage;
use Intervolga\Edu\Locator\IO\Gadgets;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\FileMessage;

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
		$parameters = static::checkParameters();

		if ($parameters) {
			if (Desktop::find() && Gadgets::find()) {
				$formId = Desktop::find()['PARAMETERS']['G_' . mb_strtoupper(Gadgets::find()
					->getName()) . '_WEB_FORM_ID'];
				static::urlChecker($formId, $todayLinkIndex, $allLinkIndex, false, false,
					[
						'todayLink' => Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_8_TODAY_URL'),
						'generalLink' => Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_8_GENERAL_URL'),
					]);
				static::urlChecker($formId, $todayLinkIndex, $allLinkIndex, '/id-from-#ID#-to-#ID#/', '', ['todayLink' => Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_8_TODAY_URL')]);
				static::urlChecker($formId, $todayLinkIndex, $allLinkIndex, '', '/id-from-#ID#-to-#ID#/?from=#DATE#&to=#DATE#', ['generalLink' => Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_8_GENERAL_URL')]);
				static::urlChecker($formId, $todayLinkIndex, $allLinkIndex, '/id-from-#ID#-to-#ID#/', '/id-from-#ID#-to-#ID#/?from=#DATE#&to=#DATE#');
			}
		}
	}

	protected static function checkParameters()
	{
		$result = false;
		$arParameters = [];
		if (Gadgets::find()) {
			$parametersPath = Gadgets::find()->getPath() . '/.parameters.php';
			$parametersFile = new File($parametersPath);
			Assert::fseExists($parametersFile);
			if ($parametersFile->isExists()) {
				include $parametersPath;

				Assert::notEmpty(
					$webForm = $arParameters['PARAMETERS']['WEB_FORM_ID'],
					Loc::getMessage(
						'INTERVOLGA_EDU.COURSE_2_LESSON_8_PARAM_WEB_FORM_ID',
						[
							'#FILE#' => FileMessage::get($parametersFile),
						]
					));
				Assert::notEmpty(
					$urlAll = $arParameters['USER_PARAMETERS']['URL_TEMPLATE_ALL'],
					Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_8_PARAM_URL_TEMPLATE_ALL',
						[
							'#FILE#' => FileMessage::get($parametersFile),
						]
					)
				);
				Assert::notEmpty(
					$urlToday = $arParameters['USER_PARAMETERS']['URL_TEMPLATE_TODAY'],
					Loc::getMessage(
						'INTERVOLGA_EDU.COURSE_2_LESSON_8_PARAM_URL_TEMPLATE_TODAY',
						[
							'#FILE#' => FileMessage::get($parametersFile),
						]
					)
				);
				$result = ($webForm && $urlAll && $urlToday);
			}
		}

		return $result;
	}

	protected static function urlChecker($formId, &$todayLinkIndex, &$allLinkIndex, $templateUrlGeneral = '', $templateUrlIndividual = '', $message = [])
	{
		$gadgetUrls = static::getGadgetUrls($formId, $todayLinkIndex, $allLinkIndex, $templateUrlGeneral, $templateUrlIndividual);
		$expectedUrls = static::getExpectedUrls($formId, $templateUrlGeneral, $templateUrlIndividual);
		if (empty($message)) {
			$message['todayLink'] = Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_8_WRONG_URL_TODAY',
				[
					'#EXPECT#' => $expectedUrls['todayLink'],
					'#VALUE#' => $gadgetUrls['todayLink'],
				]);
			$message['generalLink'] = Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_8_WRONG_URL_GENERAL',
				[
					'#EXPECT#' => $expectedUrls['todayLink'],
					'#VALUE#' => $gadgetUrls['todayLink'],
				]);
		}
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
			"URL_TEMPLATE_ALL" => $templateUrlGeneral,
			"URL_TEMPLATE_TODAY" => $templateUrlIndividual,
			"TEMPLATE_URL" => "",
			"WEB_FORM_ID" => $formId,
		];
		include $indexPath;
		$page = ob_get_contents();
		ob_clean();

		preg_match_all('/href="[\w\s\d\=\'"\/_\.\?&;\-\#\$\%\^:]*\>/iu', $page, $matches, PREG_SET_ORDER);
		foreach ($matches as $match) {
			$urls[] = mb_strcut($match[0], strpos($match[0], '"') + 1, -2);
		}

		if (strpos($urls[1], 'find_date_create_1')) {
			$allLinkIndex = 0;
			$todayLinkIndex = 1;
		}

		return [
			'todayLink' => $urls[$todayLinkIndex],
			'generalLink' => $urls[$allLinkIndex],
		];
	}

	protected static function getExpectedUrls($formId, $templateUrlGeneral, $templateUrlIndividual)
	{
		$result['generalLink'] = $templateUrlGeneral;
		$result['todayLink'] = $templateUrlIndividual;
		if (!$result['generalLink']) {
			$result['generalLink'] = static::GENERAL_LINK;
		}
		if (!$result['todayLink']) {
			$result['todayLink'] = static::TODAY_LINK;
		}

		$today = (new Date())->toString();

		$result['generalLink'] = str_replace(
			[
				'#ID#',
				'#DATE#',
			],
			[
				$formId,
				$today,
			],
			$result['generalLink']);

		$result['todayLink'] = str_replace(
			[
				'#ID#',
				'#DATE#',
			],
			[
				$formId,
				$today,
			],
			$result['todayLink']);

		return $result;
	}
}