<?php

namespace Collection\List;

use Traversable;
use Collection\List\AbstractList;
use Collection\List\Trait\LinkedListIteratorTrait;

class LinkedList extends AbstractList
{
    protected ?Node $head = null;

    public function insert(mixed $value): void
    {
        $this->head = $this->insertNode($this->head, $value);
    }

    private function insertNode(?Node $node, mixed $value): ?Node
    {
        if (null === $node) {
            $this->count++;

            return new Node($value);
        }

        $node->right = $this->insertNode($node->right, $value);
        if (null !== $node->right) {
            $node->right->left = $node;
        }

        return $node;
    }

    public function delete(mixed $value): void
    {
        $this->head = $this->deleteNode($this->head, $value);
    }

    private function deleteNode(?Node $node, mixed $value): ?Node
    {
        if (null === $node) {
            return $node;
        }

        if ($value === $node->value) {
            $this->count--;

            if (null === $node->left && null === $node->right) {
                return null;
            }

            if (null !== $node->right) {
                $node->right->left = $node->left;
            }

            if (null !== $node->left) {
                $node->left->right = $node->right;
            }
        }

        $this->deleteNode($node->right, $value);

        return $node;
    }

    public function contains(mixed $value): bool
    {
        return $this->containsNode($this->head, $value);
    }

    private function containsNode(?Node $node, mixed $value): bool
    {
        if (null === $node) {
            return false;
        } elseif ($value === $node->value) {
            return true;
        }

        return $this->containsNode($node->right, $value);
    }

    public function getIterator(): Traversable
    {
        return (function () {
            for ($node = $this->head; null != $node; $node = $node->right) {
                yield $node->value;
            }
        })();
    }
}
