<?php

namespace Collection\List\Contract;

use Countable;
use Serializable;
use IteratorAggregate;

interface ListInterface extends Countable,
                                Serializable,
                                ArrayableInterface,
                                IteratorAggregate,
                                TransformableInterface,
                                FilterableInterface,
                                IndexableInterface
{
    public function add(mixed $value): bool;

    public function addFirst(mixed $value): void;

    public function addLast(mixed $value): void;

    public function addAll(ListInterface $list): bool;

    public function removeFirst(): mixed;

    public function removeLast(): mixed;

    public function remove(mixed $value): bool;

    public function contains(mixed $value): bool;

    public function isEmpty(): bool;

    public function clear(): void;

}
