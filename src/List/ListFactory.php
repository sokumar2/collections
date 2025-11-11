<?php

namespace Collection\List;

use Collection\List\LinkedList;
use Collection\List\Type as ListType;
use Collection\List\Contract\ListInterface;

class ListFactory extends AbstractCollectionFactory
{
    public function make(ListType $type): ?ListInterface
    {
        if (ListType::LinkedList === $type) {
            return new LinkedList();
        }

        return null;
    }

}
