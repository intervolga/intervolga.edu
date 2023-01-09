<?php
namespace Intervolga\Edu\Tests\Course1\Lesson3;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Exceptions\AssertException;
use Intervolga\Edu\Tests\BaseTest;


class TestOption extends BaseTest
{
	/**
	 * @throws AssertException
	 */
	protected static function run()
	{
		$keyName = [
			'optimize_css_files' => 'Объединять CSS файлы',
			'optimize_js_files' => 'Объединять JS файлы',
			'use_minified_assets' => 'Подключать минифицированные версии CSS и JS файлов',
			'move_js_to_body' => 'Переместить весь Javascript в конец страницы',
			'compres_css_js_files' => 'Создавать сжатую копию объединенных CSS и JS файлов'
		];
		foreach ($keyName as $k => $n) {
			Assert::checkModuleOption('main', $k, 'Y', $n);
		}
	}

}