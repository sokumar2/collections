<?php

namespace SK\Collection\Queue;

use SK\Collection\Queue\Interface\QueueInterface;

abstract class AbstractQueueFactory
{
    abstract public function createInstance(): QueueInterface;

}
