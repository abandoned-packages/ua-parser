<?php

use Rector\Config\RectorConfig;
use Rector\Php54\Rector\Array_\LongArrayToShortArrayRector;
use Rector\Set\ValueObject\LevelSetList;
use Rector\ValueObject\PhpVersion;

return RectorConfig::configure()
    ->withPaths([
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ])
    ->withSkip([
        __DIR__ . '/vendor',
    ])
    ->withSkip([
        LongArrayToShortArrayRector::class,
    ])
    ->withSets([
        LevelSetList::UP_TO_PHP_74,
    ])
    ->withPhpVersion(PhpVersion::PHP_56);
