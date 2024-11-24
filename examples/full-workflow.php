<?php

require __DIR__ . '/../vendor/autoload.php';

use WoT\Core\Describe\ThingDescription;
use WoT\Core\Generate\Generator;
use WoT\Core\Parse\Parser;
use WoT\Core\Validate\Validator;

// Step 1: Create a Thing Description object
$td = new ThingDescription();
$td->setTitle("Smart Thermostat")
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

// Step 2: Generate JSON from the Thing Description
echo "Generating Thing Description JSON...\n";
$generatedJson = Generator::generate($td);
echo $generatedJson;

// Step 3: Parse the generated JSON back to an array
echo "\nParsing Generated JSON...\n";
try {
    $parsedData = Parser::parse($generatedJson);
    print_r($parsedData);
} catch (InvalidArgumentException $e) {
    echo "Error parsing JSON: " . $e->getMessage();
    exit;
}

// Step 4: Validate the parsed Thing Description
echo "\nValidating Thing Description...\n";
try {
    $thingDescription = new ThingDescription();
    $thingDescription
        ->setTitle($parsedData['title'])
        ->addProperty('temperature', $parsedData['properties']['temperature'])
        ->addProperty('status', $parsedData['properties']['status']);

    Validator::validate($thingDescription);

    echo "The Thing Description is valid.\n";
} catch (Exception $e) {
    echo "Validation failed: " . $e->getMessage();
}
