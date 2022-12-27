<?php

namespace Intervolga\Edu\Sniffer;

class StandardsTools
{
    public static function getStandardPathByNames($name): array
    {
        if (!is_array($name)) {
            $name = [$name];
        }

        $paths = [];
        foreach ($name as $n) {
            $paths[] = __DIR__."/Standards/$n/ruleset.xml";
        }

        return $paths;
    }
}
