<?php

namespace App;

use Closure;

class Functor
{
    private mixed $value;

    public function __construct(mixed $value)
    {
        $this->value = $value;
    }

    public function map(Closure $func): Functor
    {
        return new Functor($func($this->value));
    }

    public function getValue(): mixed
    {
        return $this->value;
    }
}
