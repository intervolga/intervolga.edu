<?php
namespace Intervolga\Edu\Tests\Course2\Lesson7;

use Bitrix\Main\Config\Option;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;

class SecureAuthorization extends BaseTest
{
	protected static function run()
	{
		$rsaKey = Option::get('main', '~rsa_key_pem');
		$auth = Option::get('main', 'use_encrypted_auth');
		Assert::notEmpty($rsaKey, Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_7_RSA_KEY'));
		Assert::eq($auth, 'Y', Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_7_ENCRYPTED_AUTH'));
	}
}