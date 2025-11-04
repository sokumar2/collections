<?php

namespace Collection\List\Contract;

interface ListInterface
{
    public function insert(mixed $data): void;

    public function delete(mixed $data): void;

    public function contains(mixed $data): bool;

    public function isEmpty(): bool;
}
