<?php

namespace SK\Collection\List;

use SK\Collection\List\Interface\ListInterface;

abstract class AbstractListFactory
{
    abstract public function createInstance(): ListInterface;

}
