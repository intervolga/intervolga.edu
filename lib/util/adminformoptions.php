<?php
namespace Intervolga\Edu\Util;

class AdminFormOptions
{
	protected static function foo(array $filter): array
	{
		$result = [];
		$getList = \CUserOptions::getList([], $filter);
		while ($fetch = $getList->fetch()) {
			$result = unserialize($fetch['VALUE']);
		}

		return $result;
	}

	public static function getFormOptionsForIblock(int $iblockId): array
	{
		$options = static::foo([
			'CATEGORY' => 'form',
			'NAME' => 'form_element_' . $iblockId,
			'COMMON' => 'Y',
		]);

		return static::optionToArray($options);
	}

	protected static function optionToArray(array $options): array
	{
		$result = [];
		if ($options['tabs']) {
			$tabs = explode('--;--', $options['tabs']);
			foreach ($tabs as $tab) {
				if ($tab) {
					$resultTab = [];
					$firstField = true;
					$fields = explode('--,--', $tab);
					foreach ($fields as $field) {
						$fieldArray = explode('--#--', $field);
						$title = $fieldArray[1];
						$code = $fieldArray[0];
						if ($firstField) {
							$resultTab['CODE'] = $code;
							$resultTab['TITLE'] = $title;
							$firstField = false;
						}
						else
						{
							if ($firstSign = mb_substr($title, 0, 1))
							{
								if ($firstSign == '*')
								{
									$result['REQUIRED'][] = $code;
									$title = mb_substr($title, 1);
								}
							}
							$resultTab['FIELDS'][$code] = $title;
						}
					}
					$result['TABS'][] = $resultTab;
				}
			}
		}

		return $result;
	}
}
