<?php

namespace Intervolga\Edu\Sniffer;

use PHP_CodeSniffer\Config;

class ConfigTools
{
    public static function makeConfig($standardPath = [], $files = []): Config
    {
        $config = new Config();
        $config->restoreDefaults();

        $config->reports = ['full' => null];

        if ($standardPath)
            $config->standards = $standardPath;

        if ($files)
            $config->files = $files;

        return $config;
    }
}
