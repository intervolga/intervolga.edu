<?php
namespace Intervolga\Edu\Tests\Course1\Lesson3;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Tests\BaseTest;

class TestLang extends BaseTest
{
	public static function interceptErrors()
	{
		return true;
	}

	protected static function run()
	{
		Assert::langStringExists('/local/templates/.default/include', 'header.php', 'Время работы');
		Assert::langStringExists('/local/templates/.default/include', 'footer.php', 'Время работы');
		Assert::langStringExists('/local/templates/.default/include', 'footer.php', 'Контактная информация');
		// TODO: изменить regex, чтобы не хавал кавычки, иначе не робит
		// Assert::langStringExists('/local/templates/.default/include', 'footer.php', '© 2000 - 2012 "Мебельный магазин"');
	}
}