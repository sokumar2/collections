<?php

namespace Collection\List\Contract;

use Countable;
use IteratorAggregate;

interface ListInterface extends Countable, ArrayableInterface, IteratorAggregate
{
    public function insert(mixed $value): void;

    public function delete(mixed $value): void;

    public function contains(mixed $value): bool;

    public function isEmpty(): bool;

}
