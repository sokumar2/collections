<?php

namespace Collection\List\Interface;

interface TransformableInterface
{
    public function transform(callable $callback): self;

}
