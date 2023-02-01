<?php
namespace Intervolga\Edu\Tests;

abstract class BaseTestNewsElement extends BaseTest
{
	protected static function addElement(array $iblock, $active = 'Y'): int
	{
		$news = new \CIBlockElement();
		$id = $news->add([
			'ACTIVE' => $active,
			'NAME' => 'Test ' . time(),
			'CODE' => str_replace('\\', '_', strtoupper(get_called_class())),
			'IBLOCK_ID' => $iblock['ID'],
		]);

		return intval($id);
	}

	protected static function getErrorUpdateElement($id, array $fields): string
	{
		global $APPLICATION;
		$error = '';

		$news = new \CIBlockElement();
		if (!$news->update($id, $fields)) {
			$ex = $APPLICATION->getException();
			$error = $ex->getString();
		}

		return $error;
	}

	protected static function cleanUp(array $iblock)
	{
		$order = ['SORT' => 'ASC'];
		$filter = [
			'IBLOCK_ID' => $iblock['ID'],
			'CODE' => str_replace('\\', '_', strtoupper(get_called_class())),
		];
		$select = ['ID'];
		$elementGetList = \CIBlockElement::getList($order, $filter, false, false, $select);
		while ($element = $elementGetList->getNext()) {
			\CIBlockElement::delete($element['ID']);
		}
	}
}