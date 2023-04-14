<?php
namespace Intervolga\Edu\Locator\Uf;

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\UserFieldLangTable;
use Bitrix\Main\UserFieldTable;
use Intervolga\Edu\Locator\BaseLocator;
use Intervolga\Edu\Util\Admin;

Loc::loadMessages(__FILE__);

class UfLocator extends BaseLocator
{
	protected array $filter = [];

	public function __construct(array $filter)
	{
		$this->filter = $filter;
	}

	public function getFilter(): array
	{
		return $this->filter;
	}

	public function find(): array
	{
		$result = [];
		$getList = UserFieldTable::getList([
			'filter' => $this->getFilter(),
		]);
		if ($fetch = $getList->fetch()) {
			$langGetList = UserFieldLangTable::getList([
				'filter' => [
					'USER_FIELD_ID' => $fetch['ID'],
				],
			]);
			while ($langFetch = $langGetList->fetch())
			{
				$fetch['LANG'][$langFetch['LANGUAGE_ID']] = $langFetch;
			}

			$result = $fetch;
		}

		return $result;
	}

	public function getPossibleTips(): string
	{
		$result = [];
		$filter = $this->getFilter();
		foreach ($filter as $field => $value) {
			if (mb_substr($field, 0, 1) == '=') {
				$field = mb_substr($field, 1);
			}
			if (!is_array($value)) {
				$value = [$value];
			}
			if ($loc = Loc::getMessage('INTERVOLGA_EDU.UF_' . $field)) {
				$field = $loc;
			}
			$result[] = $field . '=' . implode('||', $value);
		}

		return implode(';', $result);
	}

	protected static function getDisplayHref($find): string
	{
		return Admin::getUfUrl($find);
	}

	public static function getDisplayText($find): string
	{
		return '[' . $find['ID'] . '] ' .$find['LANG']['ru']['EDIT_FORM_LABEL'];
	}

	public static function getNameLoc(): string
	{
		return Loc::getMessage('INTERVOLGA_EDU.UF_PROPERTY');
	}
}