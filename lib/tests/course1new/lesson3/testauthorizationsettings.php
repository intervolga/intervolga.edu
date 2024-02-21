<?php
namespace Intervolga\Edu\Tests\Course1New\Lesson3;

use Bitrix\Main\Config\Option;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;

class TestAuthorizationSettings extends BaseTest
{
	const AUTHORIZATION_SETTINGS = [
		'store_password',
		'new_user_registration',
		'captcha_registration',
		'new_user_email_auth',
		'new_user_email_required',
		'secure_logout',

		'session_expand',
		'session_auth_only',
		'session_show_message',
		'use_encrypted_auth',
		'~rsa_key_pem',
	];

	protected static function run()
	{
		$moduleSettings = Option::getForModule('main');

		foreach (static::AUTHORIZATION_SETTINGS as $setting) {
			Assert::eq($moduleSettings[$setting], 'Y',
				Loc::getMessage("IV_EDU.NEW_ACADEMY.C_1.L_3.AUTHORIZATION_SETTINGS",
					[
						'#SETTING#' => Loc::getMessage("IV_EDU.NEW_ACADEMY.C_1.L_3.$setting")
					]
				)
			);
		}

	}
}