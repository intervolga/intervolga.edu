<?php
namespace Intervolga\Edu\Locator\Wizard;

use Bitrix\Main\Application;
use Bitrix\Main\Localization\Loc;
use CWizardUtil;
use Intervolga\Edu\Locator\BaseLocator;

abstract class WizardLocator extends BaseLocator
{
	public static function getDisplayText($find): string
	{
		return $find['NAME'];
	}

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.WIZARD_FIND', [
			'#WIZARD_NAME#' => static::getWizardName(),
		]);
	}

	abstract public static function getWizardName(): string;

	public static function find()
	{
		$result = [];
		include Application::getDocumentRoot() . '/bitrix/modules/main/classes/general/wizard_util.php';
		$wizardsCode = static::getWizardCode();
		foreach (CWizardUtil::GetWizardList() as $wizard) {
			if (in_array($wizard['ID'], $wizardsCode)) {
				$result = $wizard;
			}
		}

		return $result;
	}

	abstract public static function getWizardCode(): array;

	public static function getPossibleTips(): string
	{
		return implode(' || ', static::getWizardCode());
	}
}