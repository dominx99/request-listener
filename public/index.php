<?php

$headers = [];

header('Content-Type: application/json');

$response = json_encode([
    'get' => $_GET,
    'post' => $_POST,
    'files' => $_FILES,
    'cookies' => $_COOKIE,
    'request' => $_REQUEST,
    'headers' => getHeaders($_SERVER),
], JSON_PRETTY_PRINT);


saveResponse($response);

echo $response;

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

function saveResponse(string $response): void {
    $filename = date('Y-m-d') . '.log';
    $path = '/application/var/log/'. $filename;

    $logFile = fopen($path, "a") or die("Unable to open file!");

    fwrite($logFile, $response);
    fclose($logFile);
}
