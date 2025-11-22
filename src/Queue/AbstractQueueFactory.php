<?php

namespace Collection\Queue;

use Collection\Queue\Interface\QueueInterface;

abstract class AbstractQueueFactory
{
    abstract public function createInstance(): QueueInterface;

}
