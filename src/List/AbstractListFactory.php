<?php

namespace Collection\List;

use Collection\List\Interface\ListInterface;

abstract class AbstractListFactory
{
    abstract public function createInstance(): ListInterface;

}
