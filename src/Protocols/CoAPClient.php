<?php

/**
 * CoAPClient.php
 *
 * This file is part of the WoT library, a set of tools for handling
 * Web of Things (WoT) Thing Descriptions and interactions. It provides the
 * `CoAPClient` class, which is a placeholder for a CoAP protocol client.
 *
 * The `CoAPClient` class is designed to handle interactions with devices
 * using the CoAP (Constrained Application Protocol). This implementation
 * is currently a stub and will throw an exception when used.
 *
 * @category Protocols
 * @package  WoT\Protocols
 * @since    0.1.0 (Stub implementation, not functional yet)
 * @todo     Implement CoAP protocol support in future versions.
 * @author   Doğu Abaris <abaris@null.net>
 * @license  MIT
 */

namespace WoT\Protocols;

use RuntimeException;

/**
 * CoAPClient
 *
 * This class represents a CoAP (Constrained Application Protocol) client
 * for interacting with Web of Things (WoT) devices over the CoAP protocol.
 * Currently, this is a placeholder and does not provide a functional
 * implementation.
 *
 * @category Protocols
 * @package  WoT\Protocols
 * @since    0.1.0 (Stub implementation, not functional yet)
 * @todo     Implement CoAP protocol support in future versions.
 * @author   Doğu Abaris <abaris@null.net>
 * @license  MIT
 */
class CoAPClient
{
    /**
     * Send a request using the CoAP protocol.
     *
     * This method is intended to send a request to a given URI using the CoAP
     * protocol. Currently, it throws a `RuntimeException` as the functionality
     * has not been implemented yet.
     *
     * @since 0.1.0
     *
     * @param string $uri The URI of the resource to interact with.
     * @param string $method The HTTP-like method to use for the request
     *                       (e.g., "GET", "POST"). Defaults to "GET".
     *
     * @throws RuntimeException Always, as the implementation is not complete.
     * @return void
     */
    public function sendRequest(string $uri, string $method = "GET"): void
    {
        throw new RuntimeException("CoAP client is not implemented yet.");
    }
}
