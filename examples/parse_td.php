<?php

use WoT\Core\Parse\Parser;
use WoT\Core\Validate\Validator;
use WoT\Core\Describe\ThingDescription;

require __DIR__ . '/../vendor/autoload.php';

$tdJson = <<<JSON
{
    "@context": "https://w3.org/td",
    "title": "Parsed Device",
    "properties": {
        "temperature": {
            "type": "number",
            "forms": [
                {
                    "href": "/properties/temperature",
                    "op": ["readproperty"]
                }
            ]
        },
        "status": {
            "type": "boolean",
            "forms": [
                {
                    "href": "/properties/status",
                    "op": ["readproperty"]
                }
            ]
        }
    },
    "security": ["nosec"],
    "securityDefinitions": {
        "nosec": {
            "scheme": "nosec"
        }
    }
}
JSON;

try {
    $parsedData = Parser::parse($tdJson);
    print_r($parsedData);

    $thingDescription = new ThingDescription();
    $thingDescription
        ->setTitle($parsedData['title'])
        ->addProperty('temperature', $parsedData['properties']['temperature'])
        ->addProperty('status', $parsedData['properties']['status']);

    Validator::validate($thingDescription);

    echo "The Thing Description is valid.";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
