<?php

use ShipMonk\ComposerDependencyAnalyser\Config\Configuration;

$config = new Configuration();

return $config
    ->addPathToScan(__DIR__ . '/components/resource/src', isDev: false)
    ->addPathToScan(__DIR__ . '/components/resource/tests', isDev: true)
    ->addPathToScan(__DIR__ . '/contracts/resource/src', isDev: false)
    ->disableComposerAutoloadPathScan()
;
