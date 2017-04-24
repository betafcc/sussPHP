<?php
declare(strict_types=1);


function unit($arg): Generator {
    yield $arg;
}

function toIter(Iterable $iter): Generator {
    foreach ($iter as $el)
        yield $el;
}

function head(Iterable $iter) {
    return $iter->current();
}

function drop(int $n): callable {
    return function (Iterable $iter) use ($n): Generator {
        $it = toIter($iter);

        for ($i = 0; $i < $n; $i+=1) {
            $it->current();
            $it->next();
        }

        if (!$it->valid())
            $it = [];

        yield from $it;
    };
}

function tail(Iterable $iter): Generator {
    return drop(1)($iter);
}

function len(Iterable $iter): int {
    $acc = 0;
    foreach ($iter as $el)
        $acc += 1;
    return $acc;
}

function flatten(Iterable $highIter): Generator {
    foreach ($highIter as $iter)
        foreach ($iter as $el)
            yield $el;
}

function doEach(callable $func): callable {
    return function (Iterable $iter) use ($func) {
        foreach ($iter as $el)
            $func($el);
    };
}
