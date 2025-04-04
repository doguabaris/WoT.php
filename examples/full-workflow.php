<?php

require __DIR__ . '/../vendor/autoload.php';

use WoT\Core\Describe\ThingDescription;
use WoT\Core\Generate\Generator;
use WoT\Core\Parse\Parser;
use WoT\Core\Validate\Validator;

$td = new ThingDescription();
$td->setTitle("Smart Thermostat")->addProperty("temperature", [
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

echo "Generating Thing Description JSON...\n";
$generatedJson = Generator::generate($td);
echo $generatedJson;

echo "\nParsing Generated JSON...\n";
try {
    $parsedData = Parser::parse($generatedJson);
    print_r($parsedData);
} catch (InvalidArgumentException $e) {
    echo "Error parsing JSON: " . $e->getMessage();
    exit(1);
}

assert(is_array($parsedData));
/** @var array<string, mixed> $data */
$data = $parsedData;

echo "\nValidating Thing Description...\n";
try {
    $thingDescription = new ThingDescription();
    $thingDescription->setTitle($data['title'])
        ->addProperty('temperature', $data['properties']['temperature'])
        ->addProperty('status', $data['properties']['status']);

    Validator::validate($thingDescription);

    echo "The Thing Description is valid.\n";
} catch (Exception $e) {
    echo "Validation failed: " . $e->getMessage();
}
