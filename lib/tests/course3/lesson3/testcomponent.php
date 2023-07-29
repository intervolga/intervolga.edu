<?php
namespace Intervolga\Edu\Tests\Course3\Lesson3;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\Component\ComponentLocator;
use Intervolga\Edu\Locator\IO\RespondentComponent;
use Intervolga\Edu\Sniffer;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Asserts\AssertCustomComponent;

Loc::loadMessages(__FILE__);

class TestComponent extends BaseTest
{

	protected static function run()
	{
		AssertCustomComponent::customComponentLocator(RespondentComponent::class);
		$component = AssertCustomComponent::getLocatorsFound()[ComponentLocator::class][RespondentComponent::class][0];
		AssertCustomComponent::hasRequiredPhpFiles($component, RespondentComponent::class, 2);
		Assert::directoryLocator(RespondentComponent::class);
		$path = $component->getPath();
		$res = Sniffer::run([
			$path . '/component.php',
			$path . '/class.php'
		], ['lesson3-3']);
		Assert::notEmpty($res, Loc::getMessage('INTERVOLGA_EDU.CUSTOM_COMPONENT_FILE_NOT_FOUND'));
		foreach ($res as $r) {
			if (!empty($r)) {
				Assert::notEmpty($r, Loc::getMessage('INTERVOLGA_EDU.CUSTOM_COMPONENT_HAS_NOT_SUBQUERY'));
			}
		}

	}
}
