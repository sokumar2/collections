<?php

namespace Collection\List;

use Collection\List\AbstractLinkedList;

class LinkedList extends AbstractLinkedList
{
    protected ?Node $head = null;

    protected ?Node $tail = null;

    public function insert(mixed $data): void
    {
        $this->push($data);

        $this->count++;
    }

    private function push(mixed $data): void
    {
        if (null === $this->head) {
            $this->head = $this->tail = new Node($data);
        } else {
            $oldTail = $this->tail;

            $this->tail = new Node($data);

            $this->tail->left = $oldTail;
            $oldTail->right = $this->tail;
        }
    }

    public function delete(mixed $data): void
    {
        $this->head = $this->deleteNode($this->head, $data);

        $this->count--;
    }

    private function deleteNode(?Node $node, mixed $data): ?Node
    {
        if (null === $node) {
            return $node;
        }

        if ($data === $node->data) {
            if (null !== $node->left) {
                $node->left->right = $node->right;
            }

            if (null !== $node->right) {
                $node->right->left = $node->left;
            }

            $nextNode = $node->right;
            $node->left = $node->right = null;

            $node = $this->deleteNode($nextNode, $data);
        }

        return $node;
    }

    public function contains(mixed $data): bool
    {
        return $this->containsNode($this->head, $data);
    }

    private function containsNode(?Node $node, mixed $data): bool
    {
        if (null === $node) {
            return false;
        } elseif ($data === $node->data) {
            return true;
        }

        return $this->containsNode($node->right, $data);
    }

    public function isEmpty(): bool
    {
        return 0 === $this->count();
    }
}
