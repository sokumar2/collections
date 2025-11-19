<?php

namespace Collection\Stack;

use Collection\Stack\Interface\StackInterface;

abstract class AbstractStackFactory
{
    abstract public function createInstance(): StackInterface;

}
