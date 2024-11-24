<?php

return [
    'directory_list' => [
        'src',
        'tests',
        'examples',
        'vendor/phpunit/phpunit',
        'vendor/ockcyp/covers-validator',
        'vendor/justinrainbow/json-schema',
    ],
    'exclude_analysis_directory_list' => [
        'vendor/',
    ],
    'strict_method_checking' => true,
    'strict_object_checking' => true,
    'strict_property_checking' => true,
];
