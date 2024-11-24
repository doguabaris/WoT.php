<?php

/**
 * HTTPClient.php
 *
 * This file is part of the WoT library, a set of tools for handling
 * Web of Things (WoT) Thing Descriptions and interactions. It provides the
 * `HTTPClient` class, which facilitates HTTP communication with WoT devices
 * or APIs.
 *
 * The `HTTPClient` class allows sending HTTP requests to interact with
 * resources using common HTTP methods like GET, POST, PUT, and DELETE. It
 * handles JSON serialization for request bodies and error handling for
 * failed requests.
 *
 * @category Protocols
 * @package  WoT\Protocols
 * @since    0.1.0
 * @author   Doğu Abaris <abaris@null.net>
 * @license  MIT
 */

namespace WoT\Protocols;

use RuntimeException;

/**
 * HTTPClient
 *
 * This class represents an HTTP client for interacting with Web of Things
 * (WoT) devices or APIs. It supports sending requests with JSON payloads and
 * handles basic error reporting for failed requests.
 *
 * @category Protocols
 * @package  WoT\Protocols
 * @since    0.1.0
 * @author   Doğu Abaris <abaris@null.net>
 * @license  MIT
 */
class HTTPClient
{
    /**
     * Send an HTTP request to a specified URL.
     *
     * This method sends an HTTP request to the provided URL using the specified
     * HTTP method (e.g., GET, POST). It automatically encodes the request body
     * as JSON and sets the appropriate headers. If the request fails, it throws
     * a `RuntimeException` with details of the error.
     *
     * @since 0.1.0
     *
     * @param string $url    The URL of the resource to interact with.
     * @param array $data    The data to include in the request body (default: empty array).
     * @param string $method The HTTP method to use for the request (default: "GET").
     *
     * @throws RuntimeException If the HTTP request fails.
     * @return string The response body returned by the server.
     */
    public function sendRequest(string $url, array $data = [], string $method = "GET"): string
    {
        $options = [
            'http' => [
                'header' => "Content-Type: application/json\r\n",
                'method' => $method,
                'content' => json_encode($data),
            ],
        ];

        $context = stream_context_create($options);

        try {
            $result = file_get_contents($url, false, $context);
            restore_error_handler();
        } catch (RuntimeException $e) {
            restore_error_handler();
            throw new RuntimeException("Failed to send HTTP request: {$e->getMessage()}");
        }

        if ($result === false) {
            throw new RuntimeException("Failed to retrieve content from the URL.");
        }

        return $result;
    }
}
