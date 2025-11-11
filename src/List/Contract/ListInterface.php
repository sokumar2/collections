<?php

namespace Collection\List\Contract;

use Countable;
use IteratorAggregate;

interface ListInterface extends Countable, IteratorAggregate
{
    public function insert(mixed $data): void;

    public function delete(mixed $data): void;

    public function contains(mixed $data): bool;

    public function isEmpty(): bool;

    public function toArray(): array;
}
