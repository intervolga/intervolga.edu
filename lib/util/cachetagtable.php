<?php
namespace Intervolga\Edu\Util;

use Bitrix\Main\Access\Entity\DataManager;
use Bitrix\Main\Entity\IntegerField;
use Bitrix\Main\Entity\StringField;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ORM\Fields\Validators\LengthValidator;

class CacheTagTable extends DataManager
{
	/**
	 * @return string
	 */
	public static function getTableName(): string
	{
		return "b_cache_tag";
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
					'title' => Loc::getMessage('TAG_ENTITY_ID_FIELD')
				]
			),
			new StringField(
				'SITE_ID',
				[
					'validation' => [
						__CLASS__,
						'validateSiteId'
					],
					'title' => Loc::getMessage('TAG_ENTITY_SITE_ID_FIELD')
				]
			),
			new StringField(
				'CACHE_SALT',
				[
					'validation' => [
						__CLASS__,
						'validateCacheSalt'
					],
					'title' => Loc::getMessage('TAG_ENTITY_CACHE_SALT_FIELD')
				]
			),
			new StringField(
				'RELATIVE_PATH',
				[
					'validation' => [
						__CLASS__,
						'validateRelativePath'
					],
					'title' => Loc::getMessage('TAG_ENTITY_RELATIVE_PATH_FIELD')
				]
			),
			new StringField(
				'TAG',
				[
					'validation' => [
						__CLASS__,
						'validateTag'
					],
					'title' => Loc::getMessage('TAG_ENTITY_TAG_FIELD')
				]
			),
		];
	}

	/**
	 * Returns validators for SITE_ID field.
	 *
	 * @return array
	 */
	public static function validateSiteId()
	{
		return [
			new LengthValidator(null, 2),
		];
	}

	/**
	 * Returns validators for CACHE_SALT field.
	 *
	 * @return array
	 */
	public static function validateCacheSalt()
	{
		return [
			new LengthValidator(null, 4),
		];
	}

	/**
	 * Returns validators for RELATIVE_PATH field.
	 *
	 * @return array
	 */
	public static function validateRelativePath()
	{
		return [
			new LengthValidator(null, 255),
		];
	}

	/**
	 * Returns validators for TAG field.
	 *
	 * @return array
	 */
	public static function validateTag()
	{
		return [
			new LengthValidator(null, 100),
		];
	}
}