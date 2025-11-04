<?php

namespace Collection\List;

use Collection\List\Contract\ListInterface;

abstract class AbstractCollectionFactory
{
    abstract public function getInstance(): ListInterface;

}
