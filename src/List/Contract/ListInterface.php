<?php

namespace Collection\List\Contract;

use Countable;
use IteratorAggregate;

interface ListInterface extends Countable,
                                ArrayableInterface,
                                IteratorAggregate,
                                TransformableInterface,
                                FilterableInterface
{
    public function add(mixed $value): bool;

    public function remove(mixed $value): bool;

    public function contains(mixed $value): bool;

    public function isEmpty(): bool;

    public function clear(): void;

}
