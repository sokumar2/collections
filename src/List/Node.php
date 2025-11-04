<?php

namespace Collection\List;

class Node
{
    public function __construct(
        public readonly mixed $data,
        public ?Node $left = null,
        public ?Node $right = null
    ) {
    }
}
