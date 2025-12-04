<?php

namespace SK\Collection\List\Trait;

trait CountableTrait
{
    protected int $count = 0;

    public function count(): int
    {
        return $this->count;
    }
}
