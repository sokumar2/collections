<?php

namespace SK\Collection\Queue;

use SK\Collection\Queue\Queue;
use SK\Collection\Queue\Interface\QueueInterface;

class QueueFactory extends AbstractQueueFactory
{
    public function createInstance(): QueueInterface
    {
        return new Queue();
    }

}
