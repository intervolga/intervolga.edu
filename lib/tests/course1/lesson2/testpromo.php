<?php
namespace Intervolga\Edu\Tests\Course1\Lesson2;

use Bitrix\Main\Localization\Loc;
use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\IO\PromoSection;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\Menu;

class TestPromo extends BaseTest
{
    protected static function run()
    {
        Assert::directoryLocator(PromoSection::class);

        $links = Menu::getMenuLinks('/.top.menu.php', true);
        Assert::notEmpty(
            $links[PromoSection::find()->getName()],
            Loc::getMessage('INTERVOLGA_EDU.COURSE_1_LESSON_2_NOT_FOUND_PROMO_IN_MENU',
                ['#PROMO_NAME#' => PromoSection::find()->getName(),])
        );
    }
}