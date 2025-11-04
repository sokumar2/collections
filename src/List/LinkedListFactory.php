<?php

namespace Collection\List;

use Collection\List\LinkedList;
use Collection\List\Contract\ListInterface;

class LinkedListFactory
{
    public function getInstance(): ListInterface
    {
        return new LinkedList();
    }

}
