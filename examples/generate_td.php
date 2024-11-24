<?php

use WoT\Core\Describe\ThingDescription;
use WoT\Core\Generate\Generator;

require __DIR__ . '/../vendor/autoload.php';

$td = new ThingDescription();
$td->setTitle("My Device")
    ->addProperty("temperature", [
        "type" => "number",
        "forms" => [
            [
                "href" => "/properties/temperature",
                "op" => ["readproperty"]
            ]
        ]
    ])
    ->addProperty("status", [
        "type" => "boolean",
        "forms" => [
            [
                "href" => "/properties/status",
                "op" => ["readproperty"]
            ]
        ]
    ]);

$generatedTD = Generator::generate($td);

echo $generatedTD;
