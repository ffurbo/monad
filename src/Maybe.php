<?php

namespace App;

use Closure;

/**
 * @template T
 */
class Maybe
{
    /**
     * monad value
     *
     * @var T
     */
    private mixed $value;

    /**
     * constructor
     *
     * @param T $value
     */
    final public function __construct(mixed $value = null)
    {
        $this->value = $value;
    }

    /**
     * bind function
     * 
     * @template U
     *
     * @param \Closure(T): Maybe<U> $func
     * 
     * @return Maybe<T>|Maybe<U>
     */
    public function bind(Closure $func): Maybe
    {
        return $this->value === null ? $this : $func($this->value);
    }

    /**
     * get monad value
     *
     * @return T
     */
    public function getValue(): mixed
    {
        return $this->value;
    }

}
