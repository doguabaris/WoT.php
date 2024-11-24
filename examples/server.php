<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    if (isset($data['action']) && $data['action'] === 'turnOn') {
        echo json_encode([
            'status'  => 'success',
            'message' => 'Device turned on',
        ]);
    } else {
        http_response_code(400);
        echo json_encode([
            'status'  => 'error',
            'message' => 'Invalid action',
        ]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo json_encode([
        'status'  => 'online',
        'message' => 'Device is operational',
    ]);
} else {
    http_response_code(405);
    echo json_encode([
        'status'  => 'error',
        'message' => 'Method not allowed',
    ]);
}
