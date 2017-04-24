<?php
declare(strict_types=1);

require_once __DIR__.'/itertools.php';
require_once __DIR__.'/functools.php';


class Iter implements IteratorAggregate {
    private $iter;
    public function __construct(Iterable $iter) {
        $this->iter = toIter($iter);
    }

    public function getIterator(): Iterator {
        return $this->iter;
    }

    public function map(callable $fun): Iter {
        return new Iter(map($fun)($this->iter));
    }

    public function filter(callable $fun): Iter {
        return new Iter(filter($fun)($this->iter));
    }

    public function reduce(callable $fun, $initial) {
        return reduce($fun)($initial)($this->iter);
    }

    public function head() {
        return head($this->iter);
    }

    public function drop(int $n): Iter {
        return new Iter(drop($n)($this->iter));
    }

    public function tail(): Iter {
        return new Iter(tail($this->iter));
    }

    public function len(): int {
        return len($this->iter);
    }

    public function flatten(): Iter {
        return new Iter(flatten($this->iter));
    }

    public function doEach(callable $fun) {
        doEach($fun)($this->iter);
    }
}


function iter(Iterable $iter): Iter {
    return new Iter($iter);
}
