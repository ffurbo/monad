<?php

namespace App;

use Closure;

/**
 * @template T
 */
class Monad
{
    /**
     * Undocumented variable
     *
     * @var T
     */
    private mixed $value;

    /**
     * Undocumented function
     *
     * @param T $value
     */
    final public function __construct(mixed $value)
    {
        $this->value = $value;
    }

    /**
     * Undocumented function
     * @template U
     *
     * @param \Closure(T): Monad<U> $func
     * @return Monad<U>
     */
    public function bind(Closure $func): Monad
    {
        return $func($this->value);
    }

    /**
     * Undocumented function
     *
     * @return T
     */
    public function getValue(): mixed
    {
        return $this->value;
    }
}
