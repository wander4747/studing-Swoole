<?php

use Swoole\Http\Server;

$server = new Server('0.0.0.0', 8080);

$server->on('request', function($response, $request) {
    $request->end("OK");
});

$server->start();