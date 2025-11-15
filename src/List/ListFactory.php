<?php

namespace Collection\List;

use Collection\List\Type;
use Collection\List\LinkedList;
use Collection\List\Contract\ListInterface;

class ListFactory extends AbstractCollectionFactory
{
    public function make(Type $type): ?ListInterface
    {
        if (Type::LinkedList === $type) {
            return new LinkedList();
        } elseif (Type::ArrayList === $type) {
            return new ArrayList();
        }

        return null;
    }

}
