# TODO
- [x] Make a working starting point
- [ ] Learn and apply standard PHP project folder structure
- [ ] Learn Composer and convert this to a package
- [ ] Add tests
- [ ] Release

# süß/PHP

**süß** &nbsp; _/zyːs/_ <br>
&emsp; _adj_ <br>
&emsp;&emsp; sweet, cute <br>
&emsp; _noun_ <br>
&emsp;&emsp; the sound iteration makes over pure functional pipes

<!-- Micro Framework for Lazy Iterations in PHP -->

Install
-------

    composer require betafcc/suss

Usage
-----

Get an iterator/generator/iterable:
```php
// Generate all Natural numbers
function naturals(): Generator {
   for ($i = 0; true; $i+=1)
       yield i;
}
```

Use the Fluent API:
```php
// Log all even squares
suss(naturals())
    ->map(function (int $x): int { return $x*$x; })
    ->filter(function (int $x): bool { return $x % 2 === 0; })
    ->doEach(function (int $el) { echo $el, "\n"; });
```

Use the flow/pipe API:
```php
// Log all even squares
flow(naturals())(
    map(function (int $x): int { return $x*$x; }),
    filter(function (int $x): bool { return $x % 2 === 0; }),
    doEach(function (int $el) { echo $el, "\n"; }),
);
```
