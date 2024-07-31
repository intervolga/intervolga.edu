<?php
namespace Intervolga\Edu\Tool\ORM;

use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\BooleanField;
use Bitrix\Main\ORM\Fields\DatetimeField;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\StringField;
use Intervolga\Edu\Entity\EduTest;

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
	 * @return string
	 */
	public static function getObjectClass(): string {
		return EduTest::class;
	}

	/**
	 * Returns entity map definition.
	 *
	 * @return array
	 */
	public static function getMap()
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
			new DateTimeField('PASSED_DATE'),
			new BooleanField('COMPLAINT'),
			new DateTimeField('COMPLAINT_DATE'),
			new StringField('COMPLAINT_COMMENT'),
		];
	}
}