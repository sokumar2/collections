<?php

namespace Collection\List\Interface;

interface IndexableInterface
{
    public function set(int $index, mixed $value): mixed;

    public function unset(int $index): mixed;

    public function get(int $index): mixed;

    public function indexOf(mixed $value): int;

    public function lastIndexOf(mixed $value): int;

}
