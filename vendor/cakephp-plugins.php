<?php
$baseDir = dirname(dirname(__FILE__));
return [
    'plugins' => [
        'Alt3/Swagger' => $baseDir . '/vendor/alt3/cakephp-swagger/',
        'Bake' => $baseDir . '/vendor/cakephp/bake/',
        'DebugKit' => $baseDir . '/vendor/cakephp/debug_kit/',
        'Migrations' => $baseDir . '/vendor/cakephp/migrations/',
        'RestApi' => $baseDir . '/vendor/multidots/cakephp-rest-api/'
    ]
];