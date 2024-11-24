<?php

/**
 * MQTTClient.php
 *
 * This file is part of the WoT library, a set of tools for handling
 * Web of Things (WoT) Thing Descriptions and interactions. It provides the
 * `MQTTClient` class, which is a placeholder for an MQTT protocol client.
 *
 * The `MQTTClient` class is designed to handle interactions with devices
 * using the MQTT (Message Queuing Telemetry Transport) protocol. This
 * implementation is currently a stub and will throw an exception when used.
 *
 * @category Protocols
 * @package  WoT\Protocols
 * @since    0.1.0 (Stub implementation, not functional yet)
 * @todo     Implement MQTT protocol support in future versions.
 * @author   Doğu Abaris <abaris@null.net>
 * @license  MIT
 */

namespace WoT\Protocols;

use RuntimeException;

/**
 * MQTTClient
 *
 * This class represents an MQTT (Message Queuing Telemetry Transport) client
 * for interacting with Web of Things (WoT) devices using the MQTT protocol.
 * Currently, this is a placeholder and does not provide a functional
 * implementation.
 *
 * @category Protocols
 * @package  WoT\Protocols
 * @since    0.1.0 (Stub implementation, not functional yet)
 * @todo     Implement MQTT protocol support in future versions.
 * @author   Doğu Abaris <abaris@null.net>
 * @license  MIT
 */
class MQTTClient
{
    /**
     * Publish a message to an MQTT topic.
     *
     * This method is intended to publish a message to a specified topic using
     * the MQTT protocol. Currently, it throws a `RuntimeException` as the
     * functionality has not been implemented yet.
     *
     * @since 0.1.0
     *
     * @param string $topic   The MQTT topic to which the message will be published.
     * @param string $message The message to be published to the specified topic.
     *
     * @throws RuntimeException Always, as the implementation is not complete.
     * @return void
     */
    public function publish(string $topic, string $message): void
    {
        throw new RuntimeException("MQTT client is not implemented yet.");
    }
}
