<?php

namespace Collection\List;

use Collection\List\Type;
use Collection\List\Interface\ListInterface;

abstract class AbstractListFactory
{
    abstract public function make(Type $type): ?ListInterface;

}
