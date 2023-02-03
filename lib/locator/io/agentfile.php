<?php
namespace Intervolga\Edu\Locator\IO;

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

class AgentFile extends FileLocator
{
	protected static function getPaths(): array
	{
		return [
			'/local/php_interface/agent.php',
			'/local/php_interface/include/agent.php',
		];
	}

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.AGENT_FILE');
	}
}
