<?php

namespace SK\Collection\List;

use SK\Collection\List\LinkedList;
use SK\Collection\List\Interface\ListInterface;

class LinkedListFactory extends AbstractListFactory
{
    public function createInstance(): ListInterface
    {
        return new LinkedList();
    }

}
