<?php
namespace Intervolga\Edu\Tool\ORM;

use Bitrix\Main\ArgumentException;
use Bitrix\Main\DB\Result;
use Bitrix\Main\ObjectPropertyException;
use Bitrix\Main\ORM\Data\AddResult;
use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\BooleanField;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\StringField;
use Bitrix\Main\SystemException;
use DateTime;
use Exception;

class EduTestTable extends DataManager
{
	/**
	 * Returns DB table name for entity.
	 *
	 * @return string
	 */
	public static function getTableName()
	{
		return 'intervolga_edu';
	}

	/**
	 * @throws ObjectPropertyException
	 * @throws SystemException
	 * @throws ArgumentException
	 */
	public static function getByTestName(string $testName): Result
	{
		return static::getList([
			'filter' => ['TEST_NAME' => $testName],
			'ttl' => 3600
		]);
	}

	/**
	 * @throws Exception
	 */
	public static function addPassedTest(string $testName): AddResult
	{
		$date = new DateTime();

		return static::add([
			'TEST_NAME' => $testName,
			'RESULT' => true,
			'PASSED_DATE' => $date->format('d.m.Y H:i')
		]);
	}

	/**
	 * @return array
	 * @throws ArgumentException
	 * @throws ObjectPropertyException
	 * @throws SystemException
	 */
	public static function getAll(): array
	{
		$result = [];
		$rows = static::getList(['cache' => ['ttl' => 3600]])->fetchAll();
		foreach ($rows as $row){
			$result[$row['TEST_NAME']] = $row;
		}
		return $result;
	}

	/**
	 * Returns entity map definition.
	 *
	 * @return array
	 * @throws SystemException
	 */
	public static function getMap(): array
	{
		return [
			new IntegerField(
				'ID',
				[
					'primary' => true,
					'autocomplete' => true,
				]
			),
			new StringField('TEST_NAME'),
			new BooleanField('RESULT'),
			new StringField('PASSED_DATE'),
			new BooleanField('COMPLAINT'),
			new StringField('COMPLAINT_DATE'),
			new StringField('COMPLAINT_COMMENT'),
		];
	}
}