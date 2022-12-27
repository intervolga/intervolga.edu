<?php

namespace Intervolga\Edu\Sniffer;

use Throwable;

// $files - массив полных путей до файлов, которые нужно проверить
$files = [];

// $standards - массив стандартов для проверки полных путей до файлов стандартов для проверки
//  - если стандарт внешний (lib/sniffer/Standards или любая другая папка), указывается полный путь до ruleset.xml
//  - если стандарт из числа установленных (vendor/squizlabs/php_codesniffer/src/Standards) - указать название
$standards = StandardsTools::getStandardPathByNames(['General']);

// $config - Объект \PHP_CodeSniffer\Config, определяет, как будут проверяться файлы
$config = ConfigTools::makeConfig($standards, $files);

try {
    // Инициируем runner конфигом
    $runner = new Runner($config);

    // Тут сам запуск проверок
    $errs = $runner->runPHPCS();

    // Возвращается пустой массив, если ошибок нет, или массив массивов ошибок
    // - ключ - путь до файла
    //  - ключ - номер строки с ошибкой
    //   - ключ - номер позиции в строке
    //    - массив ошибок
    //     - message - сообщение об ошибке
    //     - source - код снифера, который кинул ошибку
    //     - listener - название класса снифера, который кинул ошибку
    //     - severity - строгость
    //     - fixable - может ли ошибка быть исправлена автоматически (это для PHPCBF)
    foreach ($errs as $file => $err) {
        var_dump("Файл $file");
        foreach ($err as $strNum => $row) {
            var_dump("  Строка $strNum");
            foreach ($row as $strRow => $item) {
                var_dump("  Позиция в строке $strRow");
                var_dump("      Ошибка: ", $item);
            }
        }
    }
}
catch (Throwable $exception) {
    var_dump($exception->getMessage());
}