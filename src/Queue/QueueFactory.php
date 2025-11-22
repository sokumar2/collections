<?php

namespace Collection\Queue;

use Collection\Queue\Queue;
use Collection\Queue\Interface\QueueInterface;

class QueueFactory extends AbstractQueueFactory
{
    public function createInstance(): QueueInterface
    {
        return new Queue();
    }

}
