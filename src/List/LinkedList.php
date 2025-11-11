<?php

namespace Collection\List;

use Collection\List\AbstractLinkedList;

class LinkedList extends AbstractLinkedList
{
    protected ?Node $head = null;

    public function insert(mixed $data): void
    {
        $this->head = $this->insertNode($this->head, $data);
    }

    private function insertNode(?Node $node, mixed $data): ?Node
    {
        if (null === $node) {
            $this->count++;

            return new Node($data);
        }

        $node->right = $this->insertNode($node->right, $data);
        if (null !== $node->right) {
            $node->right->left = $node;
        }

        return $node;
    }

    public function delete(mixed $data): void
    {
        $this->head = $this->deleteNode($this->head, $data);
    }

    private function deleteNode(?Node $node, mixed $data): ?Node
    {
        if (null === $node) {
            return $node;
        }

        if ($data === $node->data) {
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

        $this->deleteNode($node->right, $data);

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

    public function toArray(): array
    {
        $list = [];
        foreach($this as $data) {
            $list[] = $data;
        }

        return $list;
    }
}
