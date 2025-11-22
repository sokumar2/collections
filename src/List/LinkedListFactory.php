<?php

namespace Collection\List;

use Collection\List\LinkedList;
use Collection\List\Interface\ListInterface;

class LinkedListFactory extends AbstractListFactory
{
    public function createInstance(): ListInterface
    {
        return new LinkedList();
    }

}
