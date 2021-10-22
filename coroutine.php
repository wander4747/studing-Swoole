<?php
use Swoole\Coroutine as Co;

Co\run(function()
{
    go(function() {
        Co::sleep(2);
        echo "Coroutine 2 is done.\n";
    });

    go(function() {
        Co::sleep(1);
        echo "Coroutine 1 is done.\n";
    });
});

echo "Outside any Coroutine Context.\n";