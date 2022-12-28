<?php

namespace Intervolga\Edu\Locator\IO;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;

class HowBecomePartner extends FileLocator
{

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.HOW_BECOME_PARTNER');
	}

	protected static function getPaths(): array
	{
		Assert::directoryLocator(PartnersSection::class);
		$path = substr(PartnersSection::find()->getPath(),	strripos(PartnersSection::find()->getPath(), '/'));
		return [
			$path . '/how-become-partner.php',
			$path . '/start-to-partners.php',
		];
	}
}