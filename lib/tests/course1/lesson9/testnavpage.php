<?php
namespace Intervolga\Edu\Tests\Course1\Lesson9;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\Component\Catalog;
use Intervolga\Edu\Tests\BaseTest;

class TestNavPage extends BaseTest
{
	protected static function run()
	{
		$parameters = Catalog::find()['PARAMETERS'];
		Assert::eq($parameters['PAGE_ELEMENT_COUNT'], 5 , 'количество элементов на странице' );
		Assert::eq($parameters['PAGER_TEMPLATE'], 'arrows' , 'шаблон arrows' );
		/* включена ли вообще навигация - проверка отображения топ/бот?
		 * DISPLAY_TOP_PAGER = Y
		 * DISPLAY_BOTTOM_PAGER
		 * проверка заголовка - PAGER_TITLE? но тогда не сходится заголовок -> посмотреть как у меня на песке было
		 * */
	}
}