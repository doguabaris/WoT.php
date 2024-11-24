<?php

/**
 * Validator.php
 *
 * This file is part of the WoT library, a set of tools for handling
 * Web of Things (WoT) Thing Descriptions and validation. It provides the
 * `Validator` class, which is used to validate Thing Descriptions against
 * JSON Schema definitions.
 *
 * The `Validator` class also preprocesses Thing Descriptions to ensure they
 * conform to the required structure, such as normalizing forms and security
 * definitions.
 *
 * @category Validation
 * @package  WoT\Core\Validate
 * @since    0.1.0
 * @author   Doğu Abaris <abaris@null.net>
 * @license  MIT
 */

namespace WoT\Core\Validate;

use WoT\Core\Describe\ThingDescription;
use InvalidArgumentException;
use JsonSchema\Constraints\Factory;
use JsonSchema\Validator as JsonSchemaValidator;
use stdClass;

/**
 * Validator
 *
 * This class provides methods for validating data objects against JSON Schema
 * files, with a focus on Web of Things (WoT) Thing Descriptions. It includes
 * functionality to preprocess data to conform with WoT standards before
 * validation.
 *
 * @category Validation
 * @package  WoT\Core\Validate
 * @since    0.1.0
 * @author   Doğu Abaris <abaris@null.net>
 * @license  MIT
 */
class Validator
{
    /**
     * Validate data against a JSON Schema.
     *
     * This method validates a given data object or array against a default JSON Schema
     * file. It preprocesses the data to ensure it adheres to Web of Things (WoT)
     * Thing Description standards before performing validation.
     *
     * @since 0.1.0
     *
     * @param ThingDescription $data  The data to be validated. Can be an associative
     *                                array or an object.
     *
     * @throws InvalidArgumentException If the schema file is invalid, or validation
     *                                  fails.
     * @return void
     */
    public static function validate(ThingDescription $data): void
    {
        $schemaFile = __DIR__ . '/schemas/td-json-schema-validation.json';

        $schemaContent = file_get_contents($schemaFile);
        if ($schemaContent === false) {
            throw new InvalidArgumentException("Schema file could not be read: $schemaFile");
        }

        $schema = json_decode($schemaContent);
        if ($schema === null && json_last_error() !== JSON_ERROR_NONE) {
            throw new InvalidArgumentException("Invalid JSON schema file: " . json_last_error_msg());
        }

        $data = self::preprocessData($data);

        $validator = new JsonSchemaValidator(new Factory());
        $validator->validate($data, $schema);

        if (!$validator->isValid()) {
            $errors = array_map(
                fn($error) => "[{$error['property']}] {$error['message']}",
                $validator->getErrors()
            );
            throw new InvalidArgumentException("Validation failed: " . implode(", ", $errors));
        }
    }

    /**
     * Preprocess data for validation.
     *
     * This method ensures that the provided data object adheres to Web of Things
     * (WoT) Thing Description standards. It normalizes various fields, such as:
     * - Converting `@context` to an array.
     * - Adding default forms for properties if none are provided.
     * - Ensuring `security` and `securityDefinitions` are set.
     *
     * @since 0.1.0
     *
     * @param ThingDescription $data The data to preprocess.
     *
     * @return stdClass The preprocessed data object, ready for validation.
     */
    private static function preprocessData(ThingDescription $data): stdClass
    {
        $data = $data->toArray();

        if (isset($data['@context']) && is_string($data['@context'])) {
            $data['@context'] = [ $data['@context'] ];
        }

        if (isset($data['properties']) && is_array($data['properties'])) {
            $data['properties'] = (object)array_map(static function ($property, $key) {
                if (!is_array($property)) {
                    return $property;
                }
                if (!isset($property['forms'])) {
                    $property['forms'] = [
                        (object)[
                            "href" => "/properties/$key",
                            "op" => [ "readproperty" ],
                        ],
                    ];
                } else {
                    $property['forms'] = array_map(fn($form) => (object)$form, $property['forms']);
                }

                return (object)$property;
            }, $data['properties'], array_keys($data['properties']));
        }

        if (!isset($data['security'])) {
            $data['security'] = [ "nosec" ];
        }

        if (!isset($data['securityDefinitions'])) {
            $data['securityDefinitions'] = (object)[
                "nosec" => (object)[ "scheme" => "nosec" ],
            ];
        }

        return (object)$data;
    }
}
