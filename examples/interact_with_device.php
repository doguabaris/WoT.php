<?php

use WoT\Protocols\HTTPClient;

require __DIR__ . '/../vendor/autoload.php';

$client = new HTTPClient();

$url = "http://localhost:8000/server.php";
$data = [
    "action" => "turnOn",
];

try {
    $response = $client->sendRequest($url, $data, "POST");
    echo $response;
} catch (RuntimeException $e) {
    try {
        $response = $client->sendRequest($url, [], "GET");
        echo $response;
    } catch (RuntimeException $e) {
        echo "Error interacting with the device: " . $e->getMessage();
    }
}
