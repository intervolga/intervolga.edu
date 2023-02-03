<?php
namespace Intervolga\Edu\Tests\Course2\Lesson5_2;

use Bitrix\Main\Application;
use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\IO\CustomComponent;
use Intervolga\Edu\Sniffer;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\FileMessage;

class TestComponentCache extends BaseTest
{
	protected static function run()
	{
		Assert::directoryLocator(CustomComponent::class);
		static::cacheInClassComponent();
		static::cacheInComponentParameters();
	}

	protected static function cacheInClassComponent()
	{
		$classFile = CustomComponent::getComponentFilePath();
		$cacheComponent = Sniffer::run([Application::getDocumentRoot() . $classFile->getPath()], ['cacheInComponentClass']);
		foreach ($cacheComponent as $component) {
			$foundCache .= $component->getMessage();
		}
		Assert::notEmpty(strpos($foundCache, 'CACHE_TIME'),
			Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_5_2_NOT_FOUND_USAGE_CACHE_PARAMETER',
				[
					'#FILE#' => FileMessage::get($classFile)
				]
			)
		);
		Assert::notEmpty(strpos($foundCache, 'StartResultCache'),
			Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_5_2_NOT_FOUND_START_RESULT_CACHE',
				[
					'#FILE#' => FileMessage::get($classFile)
				]
			)
		);
	}

	protected static function cacheInComponentParameters()
	{
		$parametersFile = CustomComponent::getParametersFilePath();
		include Application::getDocumentRoot() . $parametersFile->getPath();
		Assert::notEmpty($arComponentParameters['PARAMETERS']['CACHE_TIME'],
			Loc::getMessage('INTERVOLGA_EDU.COURSE_2_LESSON_5_2_NOT_FOUND_CACHE_TIME_IN_PARAMETERS',
				[
					'#FILE#' => FileMessage::get($parametersFile)
				]
			)
		);
	}
}