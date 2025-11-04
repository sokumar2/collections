<?php

namespace Collection\List\Trait;

use Generator;
use Traversable;
use Collection\List\Node;

trait LinkedListIteratorTrait
{
    private function iterate(?Node $node): Generator
    {
        if (null === $node) {
            return $node;
        }

        yield $node->data;

        yield from $this->iterate($node->right);
    }

    public function getIterator(): Traversable
    {
        return $this->iterate($this->head);
    }
}
