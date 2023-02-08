<?php
namespace Intervolga\Edu\Tests\Course2\Lesson7;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;

class SecureAuthorization extends BaseTest
{
	public static function interceptErrors()
	{
		return true;
	}

	protected static function run()
	{
		Assert::checkModuleOptionNotEmpty(
			'main',
			'~rsa_key_pem',
			Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_7_RSA_KEY')
		);
		Assert::checkModuleOption(
			'main',
			'use_encrypted_auth',
			'Y',
			Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_7_ENCRYPTED_AUTH')
		);
	}
}