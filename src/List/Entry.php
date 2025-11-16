<?php

namespace Collection\List;

class Entry
{
    public function __construct(
        public mixed $value,
        public ?Entry $previous = null,
        public ?Entry $next = null
    ) {

    }

}
