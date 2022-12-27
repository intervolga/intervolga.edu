<?php

namespace Intervolga\Edu\Locator\IO;

use Bitrix\Main\Localization\Loc;

class AgentCheckPromo extends FileLocator
{

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.AGENT_CHECK_PROMO');
	}


	protected static function getPaths(): array
	{
		return [
			'/local/php_interface/agent.php',
		];
	}
}