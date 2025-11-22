<?php

namespace Collection\Queue;

use Collection\List\LinkedList;
use Collection\Queue\Interface\QueueInterface;
use Collection\Queue\Exception\EmptyQueueException;

class Queue extends LinkedList implements QueueInterface
{
    public function peek(): mixed
    {
        if ($this->isEmpty()) {
            throw new EmptyQueueException();
        }

        return $this->first->value;
    }

    public function dequeue(): mixed
    {
        if ($this->isEmpty()) {
            throw new EmptyQueueException();
        }

        return $this->removeFirst();
    }

    public function queue(mixed $value): mixed
    {
        $this->addLast($value);

        return $value;
    }

}