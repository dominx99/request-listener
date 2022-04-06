<?php

$headers = [];

header('Content-Type: application/json');

echo json_encode([
    'get' => $_GET,
    'post' => $_POST,
    'files' => $_FILES,
    'cookies' => $_COOKIE,
    'request' => $_REQUEST,
    'headers' => getHeaders($_SERVER),
], JSON_PRETTY_PRINT);

function getHeaders(array $server): array {

    foreach($server as $key => $value) {
        if (substr($key, 0, 5) <> 'HTTP_') {
            continue;
        }

        $header = str_replace(' ', '-', ucwords(str_replace('_', ' ', strtolower(substr($key, 5)))));
        $headers[$header] = $value;
    }

    return $headers;
}

