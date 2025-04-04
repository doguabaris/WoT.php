<?php

require __DIR__ . '/../vendor/autoload.php';

use WoT\Core\Describe\ThingDescription;

$td = new ThingDescription();
$td->setTitle("My Device")->addProperty("temperature", [
        "type" => "number",
        "forms" => [
            [
                "href" => "/properties/temperature",
                "op" => [ "readproperty" ],
            ],
        ],
    ])->addProperty("status", [
        "type" => "boolean",
        "forms" => [
            [
                "href" => "/properties/status",
                "op" => [ "readproperty" ],
            ],
        ],
    ]);

echo $td->toJSON();
