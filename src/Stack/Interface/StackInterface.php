<?php

namespace SK\Collection\Stack\Interface;

use SK\Collection\List\Interface\ListInterface;

interface StackInterface extends ListInterface
{
    public function peek(): mixed;

    public function pop(): mixed;

    public function push(mixed $value): mixed;

}