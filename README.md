# WoT.php

An open-source PHP library for working with [**Web of Things (WoT)**](https://www.w3.org/WoT/) Thing Descriptions (TD). It includes features to parse, validate, and generate TD documents. It adheres to the [W3C TD JSON Schema](https://github.com/w3c/wot-thing-description/blob/main/validation/td-json-schema-validation.json) but does not follow the [W3C WoT Scripting API](https://www.w3.org/TR/wot-scripting-api).

[![Latest Stable Version](https://poser.pugx.org/wot-php/wot-td/v?style=for-the-badge)](https://packagist.org/packages/wot-php/wot-td)
[![Latest Unstable Version](https://poser.pugx.org/wot-php/wot-td/v/unstable?style=for-the-badge)](https://packagist.org/packages/wot-php/wot-td)
[![License](https://poser.pugx.org/wot-php/wot-td/license?style=for-the-badge)](https://packagist.org/packages/wot-php/wot-td)
[![PHP Version Require](https://poser.pugx.org/wot-php/wot-td/require/php?style=for-the-badge)](https://packagist.org/packages/wot-php/wot-td)

## Features

- Describe and document Thing Descriptions programmatically.
- Generate compliant Thing Descriptions programmatically.
- Parse Thing Descriptions from JSON format.
- Validate Thing Descriptions against the W3C WoT TD schema.

## Installation

Install the library via Composer:

```bash
composer require wot-php/wot-td
```

## Usage

```php
use WoT\Core\Describe\ThingDescription;
use WoT\Core\Generate\Generator;

$td = new ThingDescription();
$td->setTitle("Smart Thermostat")
    ->addProperty("temperature", [
        "type" => "number",
        "forms" => [
            [
                "href" => "/properties/temperature",
                "op" => ["readproperty"],
            ],
        ],
    ])
    ->addProperty("status", [
        "type" => "boolean",
        "forms" => [
            [
                "href" => "/properties/status",
                "op" => ["readproperty"],
            ],
        ],
    ]);

$json = Generator::generate($td);

echo $json;
```

## Contributing

See [CONTRIBUTING.md](CONTRIBUTING.md) for contribution guidelines.

## License

This library is licensed under the [MIT License](LICENSE).
