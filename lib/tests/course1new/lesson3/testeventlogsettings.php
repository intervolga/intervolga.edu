<?php
namespace Intervolga\Edu\Tests\Course1New\Lesson3;

use Bitrix\Main\Config\Option;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;

class TestEventLogSettings extends BaseTest
{
	const EVENT_LOG_SETTINGS = [
		'event_log_logout',
		'event_log_login_success',
		'event_log_login_fail',
		'event_log_permissions_fail',
		'event_log_block_user',

		'event_log_register',
		'event_log_register_fail',
		'event_log_password_request',

		'event_log_password_change',
		'event_log_user_edit',
		'event_log_user_delete',
		'event_log_user_groups',
		'event_log_group_policy',
		'event_log_module_access',

		'event_log_file_access',
		'event_log_task',
		'event_log_marketplace',
		'user_profile_history',
	];

	protected static function run()
	{
		$moduleSettings = Option::getForModule('main');

		foreach (static::EVENT_LOG_SETTINGS as $setting) {
			Assert::eq($moduleSettings[$setting], 'Y',
				Loc::getMessage("IV_EDU.NEW_ACADEMY.C_1.L_3.EVENT_LOG_SETTINGS",
					[
						'#SETTING#' => Loc::getMessage("IV_EDU.NEW_ACADEMY.C_1.L_3.$setting")
					]
				)
			);
		}

		Assert::eq($moduleSettings['profile_history_cleanup_days'], '10',
			Loc::getMessage("IV_EDU.NEW_ACADEMY.C_1.L_3.profile_history_cleanup_days"));
	}
}