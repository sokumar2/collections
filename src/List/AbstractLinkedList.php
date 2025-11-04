<?php

namespace Collection\List;

use Countable;
use IteratorAggregate;
use Collection\List\Trait\CountableTrait;
use Collection\List\Contract\ListInterface;
use Collection\List\Trait\LinkedListIteratorTrait;

abstract class AbstractLinkedList implements ListInterface, Countable, IteratorAggregate
{
    use CountableTrait;
    use LinkedListIteratorTrait;
}
