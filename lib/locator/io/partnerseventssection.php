<?php
namespace Intervolga\Edu\Locator\IO;

use Bitrix\Main\Localization\Loc;

class PartnersEventsSection extends DirectoryLocator
{
	protected static function getRootLocator()
	{
		return PartnersSection::class;
	}

	protected static function getPaths(): array
	{
		return [
			'/event/',
			'/events/',
			'/schedule-of-event/',
			'/schedule-of-events/',
			'/schedule/',
		];
	}

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.PARTNERS_EVENTS_DIRECTORY');
	}
}
