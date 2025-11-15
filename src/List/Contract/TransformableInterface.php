<?php

namespace Collection\List\Contract;

interface TransformableInterface
{
    public function transform(callable $callback): self;

}
