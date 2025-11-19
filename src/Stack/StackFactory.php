<?php

namespace Collection\Stack;

use Collection\Stack\Stack;
use Collection\Stack\Interface\StackInterface;

class StackFactory extends AbstractStackFactory
{
    public function createInstance(): StackInterface
    {
        return new Stack();
    }

}
