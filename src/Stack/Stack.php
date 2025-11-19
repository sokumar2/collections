<?php

namespace Collection\Stack;

use Collection\List\LinkedList;
use Collection\Stack\Interface\StackInterface;
use Collection\Stack\Exception\EmptyStackException;

class Stack extends LinkedList implements StackInterface
{
    public function peek(): mixed
    {
        if ($this->isEmpty()) {
            throw new EmptyStackException();
        }

        return $this->last->value;
    }

    public function pop(): mixed
    {
        if ($this->isEmpty()) {
            throw new EmptyStackException();
        }

        return $this->removeLast();
    }

    public function push(mixed $value): mixed
    {
        $this->addLast($value);

        return $value;
    }

}