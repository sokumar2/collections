<?php

namespace Collection\List;

use Collection\List\Type as ListType;
use Collection\List\Contract\ListInterface;

abstract class AbstractCollectionFactory
{
    abstract public function make(ListType $type): ?ListInterface;

}
