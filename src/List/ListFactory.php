<?php

namespace Collection\List;

use Collection\List\Type;
use Collection\List\LinkedList;
use Collection\List\Interface\ListInterface;

class ListFactory extends AbstractListFactory
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
