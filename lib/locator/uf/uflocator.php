<?php
namespace Intervolga\Edu\Locator\Uf;

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

class UfLocator
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

	/**
	 * @return array
	 */
	public function find()
	{
		$result = [];
		$getList = \CUserTypeEntity::getList(['ID' => 'ASC'], $this->getFilter());
		if ($fetch = $getList->fetch()) {
			$result = $fetch;
		}

		return $result;
	}

	public function getPossibleTips()
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
}