<?php

namespace SK\Collection\List;

use SK\Collection\List\ArrayList;
use SK\Collection\List\Interface\ListInterface;

class ArrayListFactory extends AbstractListFactory
{
    public function createInstance(): ListInterface
    {
        return new ArrayList();
    }

}
