<?php
use Rector\Config\RectorConfig;
use Rector\TypeDeclaration\Rector\Property\TypedPropertyFromStrictConstructorRector;
use Rector\Php81\Rector\FuncCall\NullToStrictStringFuncCallArgRector;
use Rector\Php81\Rector\Property\ReadOnlyPropertyRector;

return RectorConfig::configure()
    ->withPaths([ __DIR__ . '/' ])
    ->withSkip([
        __DIR__ . '/.github', 
        __DIR__ . '/vendor', 
        __DIR__ . '/docs', 
        'rector.php', 
        '.gitignore',
        '.git',
        'CHANGELOG.md',
        'composer.json',
        'composer.lock',
        'phpunit.xml',
        'README.md',
        'CONTRIBUTING.md',
        'dev.yml',
        'LICENSE',
        'RELEASING.md',
        'run_test_resource_test.sh',
        'composer-require-checker.json'
    ])
    ->withRules([
        ReadOnlyPropertyRector::class,
        TypedPropertyFromStrictConstructorRector::class,
        NullToStrictStringFuncCallArgRector::class
    ]);