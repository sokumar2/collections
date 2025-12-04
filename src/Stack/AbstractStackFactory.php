<?php

namespace SK\Collection\Stack;

use SK\Collection\Stack\Interface\StackInterface;

abstract class AbstractStackFactory
{
    abstract public function createInstance(): StackInterface;

}
