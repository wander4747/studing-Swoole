<?php

use Swoole\Http\{Server, Response, Request};
use Swoole\Coroutine\Http\Client;

$server = new Server('0.0.0.0', 8080);

$server->on('request', function(Request $request, Response $response) {
    $channel = new chan(2);

    go(function () use ($channel) {
        $client = new Client('localhost', 8001);
        $client->get("/response-server.php");

        $content = $client->getBody();
        $channel->push($content);
    });

    go(function () use ($channel) {
        $content = file_get_contents("file.txt");
        $channel->push($content);
    });

    go(function () use ($channel, &$response) {
        $firstContent = $channel->pop();
        $secondContent = $channel->pop();
        $response->end($firstContent. ' ' .$secondContent);
    });
});

$server->start();