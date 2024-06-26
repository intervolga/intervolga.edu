<?php
namespace Intervolga\Edu\Tests\Course3\Lesson3;

use Intervolga\Edu\Asserts\Assert;
use Intervolga\Edu\Locator\IO\ComponentTemplate\RespondentTemplate;
use Intervolga\Edu\Locator\IO\CustomRespondents;
use Intervolga\Edu\Locator\IO\DirectoryLocator;
use Intervolga\Edu\Tests\BaseTest;
use Intervolga\Edu\Util\Regex;

class TestPropertyCode extends BaseTest
{
    public static function interceptErrors()
    {
        return false;
    }

    protected static function run()
    {
        static::checkComponentFile(CustomRespondents::class);
        static::checkTemplate(RespondentTemplate::class);
    }

    /**
     * @param DirectoryLocator|string $dirComponent
     */
    protected static function checkComponentFile($dirComponent)
    {
        Assert::directoryLocator($dirComponent);
        $file = $dirComponent::getComponentFile();
        Assert::fileContentNotMatches($file,
            new Regex('/(\'|")(SALARY|GENDER|AGE)(\'|")/i', '\'SALARY\', \'GENDER\', \'AGE\''));
    }

    /**
     * @param DirectoryLocator|string $dirTemplate
     */
    protected static function checkTemplate($dirTemplate)
    {
        Assert::directoryLocator($dirTemplate);
        $directory = $dirTemplate::find();

        foreach ($directory->getChildren() as $child) {
            if ($child->isFile()) {
                Assert::fileContentNotMatches($child,
                    new Regex('/(\'|")(SALARY|GENDER|AGE)(\'|")/i', '\'SALARY\', \'GENDER\', \'AGE\''));
            }
        }
    }
}