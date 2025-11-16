<?php

namespace Collection\List\Contract;

interface FilterableInterface
{
    public function filter(callable $callback): self;

}
