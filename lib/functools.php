<?php
declare(strict_types=1);


function id($arg) {
    return $arg;
}

function compose(callable $f): callable {
    return function (callable $g) use ($f): callable {
        return function ($arg) use ($f, $g) {
            return $f($g($arg));
        };
    };
}

function map(callable $func): callable {
    return function (Iterable $iter) use ($func) : Generator {
        foreach ($iter as $el)
            yield $func($el);
    };
}

function filter(callable $func): callable {
    return function (Iterable $iter) use ($func): Generator {
        foreach ($iter as $el)
            if ($func($el) === true)
                yield $el;
    };
}

function reduce(callable $func): callable {
    return function ($initial) use ($func): callable {
        return function (Iterable $iter) use ($func, $initial) {
            $acc = $initial;
            foreach ($iter as $el)
                $acc = $func($acc)($el);
            return $acc;
        };
    };
}

function pipe(callable ...$funcs): callable {
    return reduce('compose')('id')(array_reverse($funcs));
}

function flow($initial): callable {
    return function (callable ...$funcs) use ($initial) {
        return pipe(...$funcs)($initial);
    };
}
