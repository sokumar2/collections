<?php

namespace SK\Collection\List\Interface;

interface SerializableInterface
{
    public function __serialize(): array;

    public function __unserialize(array $data): void;

}
