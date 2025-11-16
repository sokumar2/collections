<?php

namespace Collection\List;

use Collection\List\Type;
use Collection\List\Contract\ListInterface;

abstract class AbstractCollectionFactory
{
    abstract public function make(Type $type): ?ListInterface;

}
