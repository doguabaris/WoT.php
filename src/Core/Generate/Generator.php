<?php

/**
 * Generator.php
 *
 * This file is part of the WoT library, a set of tools for handling
 * Web of Things (WoT) Thing Descriptions. It provides the `Generator` class,
 * which is used to serialize data into JSON format.
 *
 * The `Generator` class focuses on converting PHP associative arrays into
 * well-formatted JSON strings, making it suitable for generating Thing
 * Descriptions or other JSON-based WoT documents.
 *
 * @category Generator
 * @package  WoT\Core\Generate
 * @since    0.1.0
 * @author   Doğu Abaris <abaris@null.net>
 * @license  MIT
 */

namespace WoT\Core\Generate;

use RuntimeException;
use WoT\Core\Describe\ThingDescription;

/**
 * Generator
 *
 * This class provides a utility method for serializing associative arrays into
 * JSON strings. It ensures that the generated JSON is human-readable by
 * applying pretty-print formatting.
 *
 * @category Generator
 * @package  WoT\Core\Generate
 * @since    0.1.0
 * @author   Doğu Abaris <abaris@null.net>
 * @license  MIT
 */
class Generator
{
    /**
     * Generate a JSON string from an associative array.
     *
     * This method converts the given associative array into a JSON string using
     * `JSON_PRETTY_PRINT` for better readability. It is typically used for
     * generating Web of Things (WoT) Thing Descriptions or other JSON-based
     * documents.
     *
     * @since 0.1.0
     *
     * @param ThingDescription $data The ThingDescription object to be converted to JSON.
     *
     * @return string The pretty-printed JSON string representation of the data.
     *
     * @throws RuntimeException If JSON encoding fails.
     */
    public static function generate(ThingDescription $data): string
    {
        $json = json_encode($data->toArray(), JSON_PRETTY_PRINT);
        if ($json === false) {
            throw new RuntimeException('JSON encoding failed: ' . json_last_error_msg());
        }

        return $json;
    }
}
