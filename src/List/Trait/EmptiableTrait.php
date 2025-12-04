<?php

namespace SK\Collection\List\Trait;

trait EmptiableTrait
{
    public function isEmpty(): bool
    {
        return 0 === $this->count();
    }
}
