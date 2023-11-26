<?php

namespace App;

use Closure;

/**
 * @template T
 */
class Maybe
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
    final public function __construct(mixed $value = null)
    {
        $this->value = $value;
        // if ($this->value === null) {
        //     unset($this->value);
        // }
    }

    /**
     * Undocumented function
     * @template U
     *
     * @param \Closure(T): Maybe<U> $func
     * @return Maybe<T>|Maybe<U>
     */
    public function bind(Closure $func): Maybe
    {
        // if ($this->value === null) {
        //     return $this;
        // }
        return $this->value === null ? $this : $func($this->value);
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
