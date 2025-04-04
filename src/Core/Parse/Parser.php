<?php

/**
 * Parser.php
 *
 * This file is part of the WoT library, a set of tools for handling
 * Web of Things (WoT) Thing Descriptions and validation. It provides the
 * `Parser` class, which is used to parse JSON strings into associative arrays
 * for further processing.
 *
 * The `Parser` class ensures that the input JSON is valid and converts it into
 * a PHP array format that can be used with other classes, such as the
 * `ThingDescription` or `Validator` classes.
 *
 * @category Parsing
 * @package  WoT\Core\Parse
 * @since    0.1.0
 * @author   Doğu Abaris <abaris@null.net>
 * @license  MIT
 */

namespace WoT\Core\Parse;

use InvalidArgumentException;

/**
 * Parser
 *
 * This class provides a utility method for parsing JSON strings into
 * associative arrays. It ensures the JSON string is valid and throws an
 * exception if the format is incorrect.
 *
 * @category Parsing
 * @package  WoT\Core\Parse
 * @since    0.1.0
 * @author   Doğu Abaris <abaris@null.net>
 * @license  MIT
 */
class Parser
{
    /**
     * Parse a JSON string into an associative array.
     *
     * This method validates the JSON string and converts it into an associative
     * array. If the JSON format is invalid, an exception is thrown.
     *
     * @since 0.1.0
     *
     * @param string $json The JSON string to be parsed.
     *
     * @throws InvalidArgumentException If the JSON string is not in a valid format.
     * @return array<string, mixed> The associative array representation of the JSON data.
     */
    public static function parse(string $json): array
    {
        $data = json_decode($json, true);
        if (!is_array($data)) {
            throw new InvalidArgumentException("Expected JSON to decode into an array.");
        }

        /** @var array<string, mixed> $data */
        return $data;
    }
}
