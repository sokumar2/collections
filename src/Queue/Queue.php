<?php

namespace SK\Collection\Queue;

use SK\Collection\List\LinkedList;
use SK\Collection\Queue\Interface\QueueInterface;
use SK\Collection\Queue\Exception\EmptyQueueException;

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