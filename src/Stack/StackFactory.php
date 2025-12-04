<?php

namespace SK\Collection\Stack;

use SK\Collection\Stack\Stack;
use SK\Collection\Stack\Interface\StackInterface;

class StackFactory extends AbstractStackFactory
{
    public function createInstance(): StackInterface
    {
        return new Stack();
    }

}
