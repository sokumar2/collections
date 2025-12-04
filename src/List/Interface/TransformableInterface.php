<?php

namespace SK\Collection\List\Interface;

interface TransformableInterface
{
    public function transform(callable $callback): self;

}
