<?php

namespace Intervolga\Edu\Locator\IO;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Util\FileSystem;

class HowBecomePartner extends FileLocator
{
	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.HOW_BECOME_PARTNER');
	}

	protected static function getPaths(): array
	{
		$result = [];
		if ($section = PartnersSection::find()) {
			$result[] = FileSystem::getLocalPath(FileSystem::getInnerFile($section, 'how-to-become-a-partner.php'));
		}

		return $result;
	}
}