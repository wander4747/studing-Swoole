<?php

use Swoole\Http\{Server, Response, Request};

$server = new Server('0.0.0.0', 8080);

$server->on('request', function(Request $request, Response $response) {
    $response->end("OK");
});

$server->start();