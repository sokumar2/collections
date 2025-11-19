<?php

namespace Collection\List;

use Collection\List\ArrayList;
use Collection\List\Interface\ListInterface;

class ArrayListFactory extends AbstractListFactory
{
    public function createInstance(): ListInterface
    {
        return new ArrayList();
    }

}
