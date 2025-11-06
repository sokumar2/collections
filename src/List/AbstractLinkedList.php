<?php

namespace Collection\List;

use Collection\List\Trait\CountableTrait;
use Collection\List\Contract\ListInterface;
use Collection\List\Trait\LinkedListIteratorTrait;

abstract class AbstractLinkedList implements ListInterface
{
    use CountableTrait;
    use LinkedListIteratorTrait;
}
