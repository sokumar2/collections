<?php

namespace Collection\List\Interface;

interface FilterableInterface
{
    public function filter(callable $callback): self;

}
