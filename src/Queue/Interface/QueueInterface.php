<?php

namespace Collection\Queue\Interface;

use Collection\List\Interface\ListInterface;

interface QueueInterface extends ListInterface
{
    public function peek(): mixed;

    public function dequeue(): mixed;

    public function queue(mixed $value): mixed;

}