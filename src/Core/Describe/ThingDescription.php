<?php

/**
 * ThingDescription.php
 *
 * This file is part of the WoT library, a set of tools for handling
 * Web of Things (WoT) Thing Descriptions and validation. It provides the
 * `Description` class, which represents a WoT Thing Description.
 *
 * The `ThingDescription` class provides methods for creating a Thing Description
 * object from JSON, as well as converting it back to JSON format. This class
 * is intended to be used in conjunction with the `Validator` class for ensuring
 * compliance with WoT standards.
 *
 * @category Description
 * @package  WoT\Core\Describe
 * @since    0.1.0
 * @author   Doğu Abaris <abaris@null.net>
 * @license  MIT
 */

namespace WoT\Core\Describe;

use InvalidArgumentException;
use RuntimeException;

/**
 * ThingDescription
 *
 * This class represents a Web of Things (WoT) Thing Description. It provides
 * functionality to create Thing Description objects from JSON strings and
 * serialize them back to JSON.
 *
 * @category Description
 * @package  WoT\Core\Describe
 * @since    0.1.0
 * @author   Doğu Abaris <abaris@null.net>
 * @license  MIT
 */
class ThingDescription
{
    /**
     * The associative array representation of the Thing Description.
     *
     * @var array<string, mixed>
     */
    private array $data;

    /**
     * Constructor for Description.
     *
     * Initializes an empty Thing Description object with default context and security settings.
     *
     * @since 0.1.0
     */
    public function __construct()
    {
        $this->data = [
            "@context" => "https://www.w3.org/2019/wot/td/v1",
            "securityDefinitions" => (object)[
                "nosec" => (object)[ "scheme" => "nosec" ],
            ],
            "security" => [ "nosec" ],
        ];
    }

    /**
     * Set the title of the Thing Description.
     *
     * @since 0.1.0
     *
     * @param string $title The title to set.
     *
     * @return $this Provides a fluent interface.
     */
    public function setTitle(string $title): self
    {
        $this->data["title"] = $title;

        return $this;
    }

    /**
     * Add a property to the Thing Description.
     *
     * Each property must include a "forms" key defining interaction endpoints.
     *
     * @since 0.1.0
     *
     * @param string $name      The name of the property.
     * @param array<string, mixed> $definition The definition of the property, including "forms".
     *
     * @throws InvalidArgumentException If the definition does not contain a "forms" key.
     *
     * @return $this Provides a fluent interface.
     */
    public function addProperty(string $name, array $definition): self
    {
        if (!isset($definition["forms"])) {
            throw new InvalidArgumentException("Each property must have a 'forms' key.");
        }

        $this->data["properties"][$name] = $definition;

        return $this;
    }

    /**
     * Convert the Thing Description object to an array.
     *
     * @since 0.1.0
     *
     * @return array<string, mixed> The array representation of the Thing Description.
     */
    public function toArray(): array
    {
        return $this->data;
    }

    /**
     * Convert the Thing Description object to a JSON string.
     *
     * The output is formatted with JSON_PRETTY_PRINT for better readability.
     *
     * @since 0.1.0
     *
     * @return string The JSON string representation of the Thing Description.
     */
    public function toJSON(): string
    {
        $json = json_encode($this->data, JSON_PRETTY_PRINT);
        if ($json === false) {
            throw new RuntimeException('JSON encoding failed.');
        }

        return $json;
    }
}
